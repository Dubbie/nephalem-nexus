<?php

namespace App\Models;

use App\Interfaces\ItemInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Item extends Model implements ItemInterface
{
    protected $fillable = ['name', 'code', 'type', 'gfx_base', 'gfx_unique', 'gfx_set', 'level_requirement', 'required_strength', 'required_dexterity', 'stackable', 'width', 'height', 'max_sockets'];

    protected $appends = ['images', 'detailed_type'];

    protected $with = ['weapon', 'armor'];

    public function images(): Attribute
    {
        return Attribute::make(
            get: fn() => [
                'base' => $this->getBaseImageUrl(),
            ],
        );
    }

    public function detailedType(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getType(),
        );
    }

    public function weapon()
    {
        return $this->hasOne(Weapon::class, 'item_id', 'id');
    }

    public function armor()
    {
        return $this->hasOne(Armor::class, 'item_id', 'id');
    }

    public function stats()
    {
        return $this->hasMany(ItemPropertyStat::class);  // Connect to ItemPropertyStat
    }

    // Relationship with ItemPropertyValue to get properties
    public function propertyValues()
    {
        return $this->hasMany(ItemPropertyValue::class);
    }

    public function getType(): string
    {
        // Create a mapping array for item types and their corresponding class names
        $typeMap = [
            'axe' => 'Axe',
            'wand' => 'Wand',
            'club' => 'Club',
            'scep' => 'Scepter',
            'mace' => 'Mace',
            'hamm' => 'Hammer',
            'swor' => 'Sword',
            'knif' => 'Dagger',
            'tkni' => 'Throwing Knives',
            'taxe' => 'Throwing Axes',
            'jave' => 'Javelin',
            'spea' => 'Spear',
            'pole' => 'Polearm',
            'bow' => 'Bow',
            'sc9' => 'Scythe',
            'staf' => 'Staff',
            'xbow' => 'Crossbow',
            // 'tpot' => 'Throwing Potion',
            'h2h' => 'Claw',
            'h2h2' => 'Claw',
            'orb' => 'Orb',
            'abow' => 'Amazon Bow',
            'aspe' => 'Amazon Spear',
            'ajav' => 'Amazon Javelin',
            'boot' => 'Boots',
            'helm' => 'Helm',
            'tors' => 'Armor',
            'glov' => 'Gloves',
            'shie' => 'Shield',
            'belt' => 'Belt',
            'pelt' => 'Pelt',
            'phlm' => 'Primal Helm',
            'ashd' => 'Auric Shield',
            'head' => 'Voodoo Head',
            'circ' => 'Circlet'
        ];

        // If the type exists in the array, return the corresponding class name, otherwise log an error
        $_type = $typeMap[$this->type] ?? $this->type;

        if (!isset($typeMap[$this->type])) {
            Log::error('Unknown item type: ' . $this->type);
        }

        return $_type . " Class";
    }


    private function getBaseImageUrl(): string
    {
        return '/data/global/png/' . $this->gfx_base . '.png';
    }
}
