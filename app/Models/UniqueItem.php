<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class UniqueItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['base_item_id'];

    protected $appends = ['stats'];

    // Define relationships
    public function uniqueProperties()
    {
        return $this->hasMany(UniqueItemProperty::class, 'unique_item_id');
    }

    public function baseItem()
    {
        return $this->belongsTo(Item::class, 'base_item_id');
    }

    public function item()
    {
        return $this->morphOne(Item::class, 'itemable');
    }

    public function stats(): Attribute
    {
        return new Attribute(
            get: fn() => $this->getStats()
        );
    }

    public function normalize($debug = false)
    {
        $baseData = [
            'name' => $this->item->name,
            'base_name' => $this->baseItem->name,
            'rarity' => 'unique',
            'type' => $this->item->type,
            'gfx' => $this->item->gfx === '' ? $this->baseItem->gfx : $this->item->gfx,
            'width' => $this->item->width,
            'height' => $this->item->height,
            'level_requirement' => $this->item->level_requirement,
            'max_sockets' => $this->item->max_sockets,
            'stats' => $this->getStats(),
        ];

        // Check what base we have
        switch (class_basename($this->baseItem->itemable)) {
            case 'Armor':
                $baseData['item_type'] = "armor";
                $baseData['min_ac'] = $this->baseItem->itemable->min_ac;
                $baseData['max_ac'] = $this->baseItem->itemable->max_ac;
                $baseData['required_strength'] = $this->baseItem->itemable->required_strength;
                $baseData['block'] = $this->baseItem->itemable->block;
                break;
            case 'Weapon':
                $baseData['item_type'] = "weapon";
                break;
            default:
                throw new Exception('Item not implemented yet');
                break;
        }

        if ($debug) {
            $baseData['debug'] = $this->toArray();
        }

        return $baseData;
    }

    private function getStats()
    {
        $stats = [];

        foreach ($this->uniqueProperties as $uniqueProperty) {
            $min = $uniqueProperty->min;
            $max = $uniqueProperty->max;
            $param = $uniqueProperty->parameter;

            if (!$uniqueProperty->property) {
                continue;
            }

            $propertyStats = $uniqueProperty->property->stats;
            foreach ($propertyStats as $stat) {
                /** @var Stat $stat */
                $stats[] = $stat->getStatTexts($min, $max, $param);
            }
        }

        return $stats;
    }
}
