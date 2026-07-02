<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Store extends Model
{
    protected $guarded = [];

    protected $appends = ['status_label', 'schedule'];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the store's schedule/hours formatted text.
     */
    public function getScheduleAttribute()
    {
        if ($this->opening_time && $this->closing_time) {
            $opening = Carbon::createFromFormat('H:i:s', $this->opening_time)->format('H:i');
            $closing = Carbon::createFromFormat('H:i:s', $this->closing_time)->format('H:i');
            return "Seg - Dom: {$opening} - {$closing}";
        }
        return "Seg - Dom: 07:00 - 22:00";
    }

    /**
     * Determine if the store is open right now.
     */
    public function isOpenNow()
    {
        $status = $this->status_label;
        return $status['type'] === 'open' || $status['type'] === 'closing_soon';
    }

    /**
     * Get the dynamic status badge details.
     * Returns an array with keys: 'type' (open|closing_soon|closed), 'label', and 'color' (green|yellow|red)
     */
    public function getStatusLabelAttribute()
    {
        if ($this->status === 'Fechada' || $this->status === 'Em Breve') {
            return [
                'type' => 'closed',
                'label' => $this->status === 'Em Breve' ? 'Em Breve' : 'Fechada',
                'color' => 'red'
            ];
        }

        $now = Carbon::now('Africa/Luanda');
        $currentTime = $now->format('H:i:s');
        
        $opening = $this->opening_time;
        $closing = $this->closing_time;

        if (empty($opening) || empty($closing)) {
            return [
                'type' => 'closed',
                'label' => 'Fechada',
                'color' => 'red'
            ];
        }

        // Determine if current time falls within opening and closing times
        $isOpen = false;
        if ($closing > $opening) {
            $isOpen = $currentTime >= $opening && $currentTime <= $closing;
        } else {
            // Over midnight (e.g. 22:00 to 06:00)
            $isOpen = $currentTime >= $opening || $currentTime <= $closing;
        }

        if (!$isOpen) {
            return [
                'type' => 'closed',
                'label' => 'Fechada',
                'color' => 'red'
            ];
        }

        // Calculate if it is closing soon (within 60 minutes)
        $closingCarbon = Carbon::createFromFormat('H:i:s', $closing, 'Africa/Luanda');
        // Handle overflow if closing is past midnight and we are currently before midnight
        if ($closing < $opening && $now->format('H:i:s') >= $opening) {
            $closingCarbon->addDay();
        }
        
        $diffInMinutes = $now->diffInMinutes($closingCarbon, false);

        if ($diffInMinutes > 0 && $diffInMinutes <= 60) {
            $formattedClosing = Carbon::createFromFormat('H:i:s', $closing)->format('H:i');
            return [
                'type' => 'closing_soon',
                'label' => "Fecha às {$formattedClosing}",
                'color' => 'yellow'
            ];
        }

        return [
            'type' => 'open',
            'label' => 'Aberta agora',
            'color' => 'green'
        ];
    }
}

