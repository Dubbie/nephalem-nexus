<?php

namespace App\Models;

use App\Interfaces\ItemInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Item extends Model implements ItemInterface
{
    protected $fillable = ['name', 'code', 'type', 'gfx_base', 'gfx_unique', 'gfx_set', 'level_requirement', 'stackable', 'width', 'height', 'max_sockets'];

    protected $appends = ['images', 'detailed_type'];

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

    // public function armor()
    // {
    //     return $this->hasOne(Armor::class);
    // }

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
        switch ($this->type) {
            case 'axe':
                $_type = 'Axe';
                break;
            case 'wand':
                $_type = 'Wand';
                break;
            case 'club':
                $_type = 'Club';
                break;
            case 'scep':
                $_type = 'Scepter';
                break;
            case 'mace':
                $_type = 'Mace';
                break;
            case 'hamm':
                $_type = 'Hammer';
                break;
            case 'swor':
                $_type = 'Sword';
                break;
            case 'knif':
                $_type = 'Dagger';
                break;
            case 'tkni':
                $_type = 'Throwing Knives';
                break;
            case 'taxe':
                $_type = 'Throwing Axes';
                break;
            case 'jave':
                $_type = 'Javelin';
                break;
            case 'spea':
                $_type = 'Spear';
                break;
            case 'pole':
                $_type = 'Polearm';
                break;
            case 'bow':
                $_type = 'Bow';
                break;
            case 'sc9':
                $_type = 'Scythe';
                break;
            case 'staf':
                $_type = 'Staff';
                break;
            case 'bow':
                $_type = 'Bow';
                break;
            case 'xbow':
                $_type = 'Crossbow';
                break;
                // case 'tpot':
                //     $_type = 'Throwing Potion';
                //     break;
            case 'h2h':
            case 'h2h2':
                $_type = 'Claw';
                break;
            case 'orb':
                $_type = 'Orb';
                break;
            case 'abow':
                $_type = 'Amazon Bow';
                break;
            case 'aspe':
                $_type = 'Amazon Spear';
                break;
            case 'ajav':
                $_type = 'Amazon Javelin';
                break;
            default:
                Log::error('Unknown item type: ' . $this->type);
                $_type = $this->type;
                break;
        }

        return $_type . " Class";
    }

    private function getBaseImageUrl(): string
    {
        return '/data/global/png/' . $this->gfx_base . '.png';
    }
}
