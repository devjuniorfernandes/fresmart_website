<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Store extends Model
{
    protected $guarded = [];

    protected $casts = [
        'services_json' => 'array'
    ];

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
            try {
                $opening = Carbon::parse($this->opening_time)->format('H:i');
                $closing = Carbon::parse($this->closing_time)->format('H:i');
                return "Seg - Dom: {$opening} - {$closing}";
            } catch (\Throwable $e) {
                return "Seg - Dom: 07:00 - 22:00";
            }
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

        $opening = $this->opening_time;
        $closing = $this->closing_time;

        if (empty($opening) || empty($closing)) {
            return [
                'type' => 'closed',
                'label' => 'Fechada',
                'color' => 'red'
            ];
        }

        try {
            $now = Carbon::now('Africa/Luanda');
            $openingCarbon = Carbon::parse($opening, 'Africa/Luanda');
            $closingCarbon = Carbon::parse($closing, 'Africa/Luanda');

            $currentTime = $now->format('H:i:s');
            $openStr = $openingCarbon->format('H:i:s');
            $closeStr = $closingCarbon->format('H:i:s');

            // Determine if current time falls within opening and closing times
            $isOpen = false;
            if ($closeStr > $openStr) {
                $isOpen = $currentTime >= $openStr && $currentTime <= $closeStr;
            } else {
                // Over midnight (e.g. 22:00 to 06:00)
                $isOpen = $currentTime >= $openStr || $currentTime <= $closeStr;
            }

            if (!$isOpen) {
                return [
                    'type' => 'closed',
                    'label' => 'Fechada',
                    'color' => 'red'
                ];
            }

            // Calculate if it is closing soon (within 60 minutes)
            if ($closeStr < $openStr && $currentTime >= $openStr) {
                $closingCarbon->addDay();
            }

            $diffInMinutes = $now->diffInMinutes($closingCarbon, false);

            if ($diffInMinutes > 0 && $diffInMinutes <= 60) {
                $formattedClosing = $closingCarbon->format('H:i');
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
        } catch (\Throwable $e) {
            return [
                'type' => 'closed',
                'label' => 'Fechada',
                'color' => 'red'
            ];
        }
    }
}
