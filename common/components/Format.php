<?php
namespace common\components;

class Format{

    public static function date( $datetime, $from='Y-m-d', $to = 'm/d/Y' ){

        if( $datetime == '' ) return '';

        if( !$date = \DateTime::createFromFormat($from, $datetime) )
            if( !$date = \DateTime::createFromFormat($from.' H:i:s', $datetime) )
                if( !$date = \DateTime::createFromFormat($to, $datetime) )
                    $date = \DateTime::createFromFormat($to.' H:i:s', $datetime);


        return $date->format($to);

    }

}