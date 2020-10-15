<?php


namespace App\Modules\query;


class QueryOracle
{
    /**
     * !Сверка ГП
     * @param $division
     * @param $month
     * @param $year
     * @return string
     */
    public static final function qu1($division, $month, $year):string {
        return "SELECT  mm.* from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
--\'TRM -----> OSV \',
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT_GP e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV_GP o     
  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
 --  e.\"Лицевой счет\" IN (110611160) AND -- 190102102 ОСВ и
  e.C_DIVISION = '".$division."' AND 
  e.N_YEAR     = ".$year."  AND
  e.N_MONTH    = ".$month." AND   
  e.N_YEAR = o.\"ГОД\"      AND 
  e.N_MONTH = o.\"МЕСЯЦ\"
  
  
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm 
WHERE 

(mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0 -- нач с пер
or (mm.n3-mm.o3) NOT in 0 -- нач без пер
or (mm.n4-mm.o4) NOT in 0 -- нач полная
or (mm.n5-mm.o5) NOT in 0 -- оплата
or (mm.n6-mm.o6) NOT in 0 -- переплата
or (mm.n9-mm.o9) NOT in 0   -- сальдо на конец месяца";
    }

    /**
     * !Сверка и ОСВ
     * @param $division
     * @param $month
     * @param $year
     * @return string
     */
    public static final function qu2($division, $month, $year):string {
        return "SELECT  mm.* from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
--\'TRM -----> OSV \',
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV o     
  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
 --  e.\"Лицевой счет\" IN (110611160) AND -- 190102102 ОСВ и
  e.C_DIVISION = '".$division."'  AND
  e.N_YEAR     = ".$year."  AND
  e.N_MONTH    = ".$month." AND   
  e.N_YEAR = o.\"ГОД\"      AND 
  e.N_MONTH = o.\"МЕСЯЦ\"
  --AND e.\"Лицевой счет\" IN (210101088) --210101088
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm 
WHERE 

(mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0 -- нач с пер
or (mm.n3-mm.o3) NOT in 0 -- нач без пер
or (mm.n4-mm.o4) NOT in 0 -- нач полная
or (mm.n5-mm.o5) NOT in 0 -- оплата
or (mm.n6-mm.o6) NOT in 0 -- переплата
or (mm.n9-mm.o9) NOT in 0   -- сальдо на конец месяца";
    }

    /**
     * !Сверка Пени
     * @param $division
     * @param $month
     * @param $year
     * @return string
     */
    public static final function qu3($division, $month, $year):string {
        return "SELECT  mm.* from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
--\'TRM -----> OSV \',
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT_PENY e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV_PENY o     
  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
 --  e.\"Лицевой счет\" IN (110611160) AND -- 190102102 ОСВ и
  e.C_DIVISION = '".$division."' AND  
  e.N_YEAR = ".$year." AND
  e.N_MONTH = ".$month." AND   
  e.N_YEAR = o.\"ГОД\" AND 
  e.N_MONTH = o.\"МЕСЯЦ\"
  
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm 
  where
  (mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0 -- нач с пер
or (mm.n3-mm.o3) NOT in 0 -- нач без пер
or (mm.n4-mm.o4) NOT in 0 -- нач полная
or (mm.n5-mm.o5) NOT in 0 -- оплата
or (mm.n6-mm.o6) NOT in 0 -- переплата
or (mm.n9-mm.o9) NOT in 0   -- сальдо на конец месяца";
    }

    /**
     * !Сверка Штраф
     * @param $division
     * @param $month
     * @param $year
     * @return string
     */
    public static final function qu4($division, $month, $year):string {
        return "SELECT  mm.* from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
--'TRM -----> OSV '--,
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT_SHTRAF e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV_SHTRAF o     
  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
  --e.\"Лицевой счет\" IN (110611160) AND -- 190102102 ОСВ и
  e.C_DIVISION = '".$division."' AND  
  e.N_YEAR     = ".$year." AND
  e.N_MONTH    = ".$month." AND   
  e.N_YEAR = o.\"ГОД\" AND 
  e.N_MONTH = o.\"МЕСЯЦ\"
  
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm 
WHERE 
(mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0 -- нач с пер
or (mm.n3-mm.o3) NOT in 0 -- нач без пер
or (mm.n4-mm.o4) NOT in 0 -- нач полная
or (mm.n5-mm.o5) NOT in 0 -- оплата
or (mm.n6-mm.o6) NOT in 0 -- переплата
or (mm.n9-mm.o9) NOT in 0 -- сальдо на конец месяца";
    }

    /**
     * Сверка финансов кол-во ошибок
     * @return string
     */
    public static final function qu5():string {
        return "SELECT  mm.C_DIVISION, 'ОСН', mm.N_YEAR, mm.N_MONTH, COUNT(distinct(mm.\"Лицевой счет\")) as cnt from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
'TRM -----> OSV ',
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV o     
  --INNER JOIN TRM_CHECK_EXPORT_OSV o

  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
 --  e.\"Лицевой счет\" IN (110301161) AND -- 190102102 ОСВ и
-- e.C_DIVISION = :division  AND 
  e.N_YEAR = o.\"ГОД\"
  and e.N_MONTH = o.\"МЕСЯЦ\"

  
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm

WHERE 
   (mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0
or (mm.n3-mm.o3) NOT in 0
or (mm.n4-mm.o4) NOT in 0
or (mm.n5-mm.o5) NOT in 0
or (mm.n6-mm.o6) NOT in 0
or (mm.n9-mm.o9) NOT in 0
--or (mm.n1-mm.n4) not IN 0
--or (mm.n5-mm.n7) NOT IN 0
--OR (mm.n8-(mm.n5-mm.n6)) not IN 0 

group BY mm.C_DIVISION,mm.N_YEAR, mm.N_MONTH


UNION ALL

SELECT  mm.C_DIVISION, 'Гос.пошлина', mm.N_YEAR, mm.N_MONTH, COUNT(distinct(mm.\"Лицевой счет\")) from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
'TRM -----> OSV ',
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT_GP e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV_GP o     
  --INNER JOIN TRM_CHECK_EXPORT_OSV o

  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
 --  e.\"Лицевой счет\" IN (110301161) AND -- 190102102 ОСВ и
-- e.C_DIVISION = :division  AND 
  e.N_YEAR = o.\"ГОД\"
  and e.N_MONTH = o.\"МЕСЯЦ\"

  
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm

WHERE 
   (mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0
or (mm.n3-mm.o3) NOT in 0
or (mm.n4-mm.o4) NOT in 0
or (mm.n5-mm.o5) NOT in 0
or (mm.n6-mm.o6) NOT in 0
or (mm.n9-mm.o9) NOT in 0
--or (mm.n1-mm.n4) not IN 0
--or (mm.n5-mm.n7) NOT IN 0
--OR (mm.n8-(mm.n5-mm.n6)) not IN 0 

      group BY mm.C_DIVISION,mm.N_YEAR, mm.N_MONTH


  UNION ALL

SELECT  mm.C_DIVISION, 'Штрафы', mm.N_YEAR, mm.N_MONTH, COUNT(distinct(mm.\"Лицевой счет\")) from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
'TRM -----> OSV ',
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT_SHTRAF e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV_SHTRAF o     
  --INNER JOIN TRM_CHECK_EXPORT_OSV o

  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
 --  e.\"Лицевой счет\" IN (110301161) AND -- 190102102 ОСВ и
-- e.C_DIVISION = :division  AND 
  e.N_YEAR = o.\"ГОД\"
  and e.N_MONTH = o.\"МЕСЯЦ\"

  
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm

WHERE 
   (mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0
or (mm.n3-mm.o3) NOT in 0
or (mm.n4-mm.o4) NOT in 0
or (mm.n5-mm.o5) NOT in 0
or (mm.n6-mm.o6) NOT in 0
or (mm.n9-mm.o9) NOT in 0
--or (mm.n1-mm.n4) not IN 0
--or (mm.n5-mm.n7) NOT IN 0
--OR (mm.n8-(mm.n5-mm.n6)) not IN 0 

   group BY mm.C_DIVISION,mm.N_YEAR, mm.N_MONTH

  UNION ALL  

SELECT  mm.C_DIVISION, 'Пеня',mm.N_YEAR, mm.N_MONTH, COUNT(distinct(mm.\"Лицевой счет\")) from (
SELECT 
xx.C_DIVISION,
xx.\"Лицевой счет\",
xx.N_YEAR,
xx.N_MONTH,
case WHEN xx.n0 is NULL THEN 0 ELSE xx.n0 END AS n0,
case WHEN xx.n1 is NULL THEN 0 ELSE xx.n1 END AS n1,
case WHEN xx.n2 is NULL THEN 0 ELSE xx.n2 END as n2,
case WHEN xx.n3 is NULL THEN 0 ELSE xx.n3 END AS n3,
xx.n2+xx.n3 as n4,
case WHEN xx.n5 is NULL THEN 0 ELSE xx.n5 END AS n5,
case WHEN xx.n6 is NULL THEN 0 ELSE xx.n6 END as n6,
case WHEN xx.n7 is NULL THEN 0 ELSE xx.n7 END as n7,
case WHEN xx.n8 is NULL THEN 0 ELSE xx.n8 END as n8,
case WHEN xx.n9 is NULL THEN 0 ELSE xx.n9 END as n9,
'TRM -----> OSV ',
case WHEN xx.n00 is NULL THEN 0 ELSE xx.n00 END AS o0,
case WHEN xx.n11 is NULL THEN 0 ELSE xx.n11 END as o1,
case WHEN xx.n22 is NULL THEN 0 ELSE xx.n22 END as o2,
case WHEN xx.n33 is NULL THEN 0 ELSE xx.n33 END as o3,
case WHEN xx.n44 is NULL THEN 0 ELSE xx.n44 END as o4,
case WHEN xx.n55 is NULL THEN 0 ELSE xx.n55 END as o5,
case WHEN xx.n66 is NULL THEN 0 ELSE xx.n66 END as o6,
case WHEN xx.n99 is NULL THEN 0 ELSE xx.n99  END  AS o9
    -- по пени и прочей сверяем только n0,n1,n2,n3,n4,n9
  from (
SELECT 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\" AS n0,
  e.\"Начислено TRM_OSV\" AS n1,
  e.\"Начислено, руб  (перерасчеты)\" AS n2,
  e.\"Начислено (без перерасчетов)\" AS n3,
  -- N4 = ПЕР+БЕЗ.ПЕР
  e.\"Оплачено TRM_OSV\" AS n5,  
  e.\"Переплата\" as n6,
  e.\"Оплата OPL\" as n7,
  e.\"Начислено TRM_ACC_OPL\" AS n8,
  e.\"Задолж.на нач.период+1\" as n9,
  SUM(o.\"Задолж.на нач.периода\") AS n00,
  SUM(o.\"Начислено, руб\") AS n11,
  SUM(o.\"Начислено, руб  (пер.)\") AS n22,
  SUM(o.\"Начислено, руб  (без пер.)\") AS n33,
  SUM(o.\"Начислено, руб  (пер.)\") + SUM(o.\"Начислено, руб  (без пер.)\") AS n44,
  SUM(o.\"Оплачено, руб\") as n55,
  SUM(o.\"Переплата, руб\") as n66,
  SUM(o.\"Задолж.на нач.след.периода\") AS n99
  
  from TRM_CH_EXPORT_PENY e

  LEFT OUTER JOIN TRM_CHECK_EXPORT_OSV_PENY o     
  --INNER JOIN TRM_CHECK_EXPORT_OSV o

  ON e.\"Лицевой счет\" = o.\"Код абонента\"

  WHERE 
  --e.\"Лицевой счет\" IN (190104166,190102154,190102182,190104055,190104063)  AND 
 --  e.\"Лицевой счет\" IN (110301161) AND -- 190102102 ОСВ и
-- e.C_DIVISION = :division  AND 
  e.N_YEAR = o.\"ГОД\"
  and e.N_MONTH = o.\"МЕСЯЦ\"

  
  GROUP BY 
  e.C_DIVISION,
  e.\"Лицевой счет\",e.N_YEAR,e.N_MONTH,
  e.\"Задолж.на нач.периода\",
  e.\"Начислено TRM_OSV\",
  e.\"Начислено, руб  (перерасчеты)\",
  e.\"Начислено (без перерасчетов)\",
  e.\"Начислено\",
  e.\"Оплачено TRM_OSV\",
  e.\"Переплата\",
  e.\"Оплата OPL\",
  e.\"Начислено TRM_ACC_OPL\",
  e.\"Задолж.на нач.период+1\") xx ) mm

WHERE 
   (mm.n0-mm.o0) NOT in 0
or (mm.n1-mm.o1) NOT in 0 
or (mm.n2-mm.o2) NOT in 0
or (mm.n3-mm.o3) NOT in 0
or (mm.n4-mm.o4) NOT in 0
or (mm.n5-mm.o5) NOT in 0
or (mm.n6-mm.o6) NOT in 0
or (mm.n9-mm.o9) NOT in 0
--or (mm.n1-mm.n4) not IN 0
--or (mm.n5-mm.n7) NOT IN 0
--OR (mm.n8-(mm.n5-mm.n6)) not IN 0 

      group BY mm.C_DIVISION,mm.N_YEAR, mm.N_MONTH
  ORDER BY 1 DESC
";
    }
}
