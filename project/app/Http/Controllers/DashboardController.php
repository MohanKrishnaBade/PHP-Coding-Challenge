<?php

namespace App\Http\Controllers;

use App\Caregiver;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $caregiverPositionArr = $caregiverCountArr = [];
        $caregiver = new Caregiver();
        foreach ($caregiver->getCaregiversData() as $item) {
            $caregiverPositionArr[] = $item->position;
            $caregiverCountArr[] = $item->caregivers_count;
        }
        $dashBoardData = [
            'chart_data' => [
                'caregiver_position_arr' => json_encode($caregiverPositionArr),
                'caregiver_count_arr' => json_encode($caregiverCountArr),
            ],
            'table_data' => $caregiver->getTop10SkilledNurses()
        ];

        return view('dashboard', compact('dashBoardData'));
    }
}
