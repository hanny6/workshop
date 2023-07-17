<?php
if (strcmp($page, "absen")==0) {
        if (isset($_SESSION['ank'])) {
          include './view/absen.php';
        } elseif (isset($_SESSION['adm'])) {
          include './view/adm/absen.php';
        }
      }elseif (strcmp($page, "absensi")==0) {
        
        if (isset($_SESSION['ank'])) {
          include './view/detail_absen.php';
          } elseif (isset($_SESSION['adm'])) {
            include './view/adm/detail_absen.php';
          }
      } elseif (strcmp($page, "add_anak")==0) {
        if (!isset($_SESSION['adm'])) {
            header("location:home");
        }else {
            include './view/adm/add_anak.php';
        }
      } elseif (strcmp($page, "anak")==0) {
        if (!isset($_SESSION['adm'])) {
            header("location:home");
        }else {
            include './view/adm/anak.php';
        }
      } elseif (strcmp($page, "katasandi")==0) {
        if (!isset($_SESSION['adm'])) {
            header("location:home");
        }else {
            include './view/adm/katasandi.php';
        }
      } elseif (strcmp($page, "keluar")==0) {
        header("location:view/logout.php");
      } else {
        header("location:absen");
      }
?>