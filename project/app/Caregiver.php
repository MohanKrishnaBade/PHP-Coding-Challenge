<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Caregiver extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'license_expiration' => 'date:Y-m-d',
    ];

    /**
     * Get the agency that the caregiver belongs to.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCaregiversData()
    {
        $caregivers = DB::table('caregivers')
            ->select(DB::raw('position, count(*) as caregivers_count'))
            ->groupBy('position')
            ->havingRaw('count(position) >= ?', [1])
            ->orderBy('caregivers_count')
            ->get();

        return $caregivers;
    }

    /**
     * get list of skilled nurses.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTop10SkilledNurses()
    {
        $skilledNurses = DB::table('caregivers')
            ->where('position', 'Skilled Nurse')
            ->orderBy('license_expiration')
            ->skip(0)
            ->take(10)
            ->get();

        return $skilledNurses;
    }
}
