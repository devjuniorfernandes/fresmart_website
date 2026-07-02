<?php
use Illuminate\Support\Str;

foreach (\App\Models\Recipe::all() as $m) {
    if (!$m->slug) {
        $m->slug = Str::slug($m->title);
        $m->save();
    }
}
foreach (\App\Models\Store::all() as $m) {
    if (!$m->slug) {
        $m->slug = Str::slug($m->name);
        $m->save();
    }
}
foreach (\App\Models\Service::all() as $m) {
    if (!$m->slug) {
        $m->slug = Str::slug($m->name);
        $m->save();
    }
}
foreach (\App\Models\Campaign::all() as $m) {
    if (!$m->slug) {
        $m->slug = Str::slug($m->title);
        $m->save();
    }
}
echo "Slugs updated successfully.\n";
