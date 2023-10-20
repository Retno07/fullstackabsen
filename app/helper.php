<?php

use Carbon\Carbon;

    function format_date($date) {
        $output = Carbon::parse($date);
        $output = $output->format('d M Y');
        return $output;
    }

    function encode($string) {
        $output =explode("|","$string");
        return $output;
    }

    function get_valueMakul($tabel,$id,$col) {
        $output=NULL;
        $data = DB::table($tabel)->where('id_mata_kuliah',$id)->get();
        foreach ($data as $d) {
            $output=$d->$col;
        }

            return $output;  
    }
    
    function get_valueProdi($tabel,$id,$col) {
        $output=NULL;
        $data = DB::table($tabel)->where('id_prodi',$id)->get();
        foreach ($data as $d) {
            $output=$d->$col;
        }

            return $output;  
    }

    function get_valueMhs($tabel,$id,$col) {
        $output=NULL;
        $data = DB::table($tabel)->where('nim_mahasiswa',$id)->get();
        foreach ($data as $d) {
            $output=$d->$col;
        }

            return $output;  
    }

    function get_value($tabel,$id,$col) {
        $output=NULL;
        $data = DB::table($tabel)->where('id',$id)->get();
        foreach ($data as $d) {
            $output=$d->$col;
        }

            return $output;  
    }

    function has_dupes($array) {
        return count($array) !== count(array_unique($array));
    }

    function decode($input,$tipe,$request) {
        $output ="";
        foreach ($request as $key => $value) {
           $q= ($value[$tipe]);
           $output = $output ."|". $q;
           
        }
        $output = substr($output,1);
        return $output;
    }

    function ambil_satudata($tabel,$id) {
        if (Schema::hasColumn($tabel,'deleted')) {
           $data = DB::table($tabel)->where('id',$id)->where('deleted','<>',1)->get();
        }
        else {
            $data = DB::table($tabel)->where('id',$id)->get();
        }
      
       return ($data);
   }

   function ambil_satudataMakul($tabel,$id) {
    if (Schema::hasColumn($tabel,'deleted')) {
       $data = DB::table($tabel)->where('id_identity',$id)->where('deleted','<>',1)->get();
    }
    else {
        $data = DB::table($tabel)->where('id_identity',$id)->get();
    }
  
   return ($data);
   }

   function ambil_satudataMhs($tabel,$id) {
    if (Schema::hasColumn($tabel,'deleted')) {
       $data = DB::table($tabel)->where('nim_mahasiswa',$id)->where('deleted','<>',1)->get();
    }
    else {
        $data = DB::table($tabel)->where('nim_mahasiswa',$id)->get();
    }
  
   return ($data);
   }

   function ambil_semuadata($tabel) {
    if (Schema::hasColumn($tabel,'deleted')) {
        $data = DB::table($tabel)->orderBy('id', 'desc')->where('deleted','<>',1)->get();
    }
    else {
        $data = DB::table($tabel)->orderBy('id', 'desc')->get();     
    }
    
    return ($data);
}