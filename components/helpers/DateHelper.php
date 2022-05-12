<?php

namespace app\components\helpers;

class DateHelper
{
    //PARA: Date Should In YYYY-MM-DD Format
    //RESULT FORMAT:
    // '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'      =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
    // '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
    // '%m Month %d Day'                                            =>  3 Month 14 Day
    // '%d Day %h Hours'                                            =>  14 Day 11 Hours
    // '%d Day'                                                     =>  14 Days
    // '%h Hours %i Minute %s Seconds'                              =>  11 Hours 49 Minute 36 Seconds
    // '%i Minute %s Seconds'                                       =>  49 Minute 36 Seconds
    // '%h Hours                                                    =>  11 Hours
    // '%a Days                                                     =>  468 Days
    public static function dateDifference($date_1, $date_2 = null, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        if (empty($date_2)) {
            $datetime2 = date_create();
        } else {
            $datetime2 = date_create($date_2);
        }


        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);
    }

    public static function getSecondsInterval($date_1, $date_2 = null)
    {
        $date = new \DateTime($date_1);
        if (empty($date_2)) {
            $date2 = new \DateTime('now');
        } else {
            $date2 = new \DateTime($date_2);
        }

        return $date2->getTimestamp() - $date->getTimestamp();
    }
}
