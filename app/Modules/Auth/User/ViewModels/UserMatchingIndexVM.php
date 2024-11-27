<?php

namespace App\Modules\Auth\User\ViewModels;

use App\Modules\Auth\User\Models\Language;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserMatchingIndexVM
{

    public static function handle($request)
    {
        //******************** Base Query *********************//
        $query = User::select('users.*', DB::raw('timestampdiff(YEAR,users.dob,now()) as age'));
        $query->where('users.id', '!=', Auth::id())->whereNotNull('email');

        //******************** Remove all send ids *********************//
        $query->whereNotIn('users.id', function ($subQuery) {
            $subQuery->select('request_to')->from('match_requests')->where('request_from', Auth::id());
        });

        //******************** Filters *********************//

        //******************** Gender *********************//
        if (isset($request->gender)) {
            if (is_array($request->gender)) {
                $query->whereIn('users.gender', $request->gender);
            } else {
                if ($request->gender == 0 || $request->gender == '0') {
                    $query->where('users.gender', 'man');
                } else if ($request->gender == 1 || $request->gender == '1') {
                    $query->where('users.gender', 'woman');
                } else {
                    $query->where('users.gender', $request->gender);
                }
            }
        }

        //******************** Age *********************//
        if (isset($request->age)) {
            if (is_array($request->age)) {
                $query->where(function ($subQuery) use ($request) {

                    //******************** If no results increase margins *********************//
                    $subQuery->whereBetween(DB::raw('timestampdiff(YEAR,dob,now())'), $request->age);
                    if ($subQuery->count() === 0 && $request->two_years_margin) {
                        $age = [(int)$request->age[0] - 2, (int)$request->age[0] + 2];
                        $subQuery->orWhereBetween(DB::raw('timestampdiff(YEAR,dob,now())'), $age);
                    }
                });
            } else {
                $query->where(DB::raw('timestampdiff(YEAR,dob,now())'), $request->age);
            }
        }

        //******************** Height *********************//
        if (isset($request->height)) {
            if (is_array($request->height)) {
                $query->whereBetween('users.height', $request->height);
            } else {
                $query->where('users.height', $request->height);
            }
        }

        //******************** Horoscope *********************//
        if (isset($request->horoscope)) {
            if (is_array($request->horoscope)) {
                $query->whereIn('users.horoscope', $request->horoscope);
            } else {
                $query->where('users.horoscope', $request->horoscope);
            }
        }

        //******************** Exercise *********************//
        if (isset($request->exercise)) {
            if (is_array($request->exercise)) {
                $query->whereIn('users.exercise', $request->exercise);
            } else {
                $query->where('users.exercise', $request->exercise);
            }
        }

        //******************** Smoking *********************//
        if (isset($request->smoking)) {
            if (is_array($request->smoking)) {
                $query->whereIn('users.smoking', $request->smoking);
            } else {
                $query->where('users.smoking', $request->smoking);
            }
        }

        //******************** Have Kids *********************//
        if (isset($request->have_kids)) {
            if (is_array($request->have_kids)) {
                $query->whereIn('users.have_kids', $request->have_kids);
            } else {
                $query->where('users.have_kids', $request->have_kids);
            }
        }

        //******************** Want Kids *********************//
        if (isset($request->want_kids)) {
            if (is_array($request->want_kids)) {
                $query->whereIn('users.want_kids', $request->want_kids);
            } else {
                $query->where('users.want_kids', $request->want_kids);
            }
        }

        //******************** Martial Status *********************//
        if (isset($request->martial_status)) {
            if (is_array($request->martial_status)) {
                $query->whereIn('users.martial_status', $request->martial_status);
            } else {
                $query->where('users.martial_status', $request->martial_status);
            }
        }

        //******************** Religion *********************//
        if (isset($request->religion)) {
            if (is_array($request->religion)) {
                $query->whereIn('users.religion', $request->religion);
            } else {
                $query->where('users.religion', $request->religion);
            }
        }

        //******************** Languages *********************//
        if (isset($request->languages)) {
            if (is_array($request->languages)) {
                $languages_ids = Language::whereIn('name', $request->languages)->pluck('id');
                $query->join('users_vs_languages', function ($join) use ($languages_ids) {
                    $join->on('users.id', '=', 'users_vs_languages.user_id')
                        ->whereIn('users_vs_languages.language_id', $languages_ids);
                });
            } elseif ($request->languages) {
                $language_id = Language::where('name', $request->languages)->first()->id;
                $query->join('languages', function ($subQuery) use ($language_id) {
                    $subQuery->on('users.id', '=', 'languages.user_id')
                        ->where('language_id', $language_id);
                });
            }
        }
        return $query
            ->inRandomOrder()
            ->distinct()
//            ->limit(3)
            ->get();
    }

    public static function toArray($request)
    {
        return ['users' => self::handle($request)];
    }
}
