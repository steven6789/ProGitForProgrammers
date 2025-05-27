<?php

echo "<br>";

echo "<br>";

header("Refresh: 3");
echo "頁面將在 3 秒後重新整理...";

echo "<br>";

echo "<br>";

$start_time = microtime(true);

// 數字組合定義
$C = [3, 4, 13, 16, 18, 24, 28, 33, 36]; // 修正：將中文
$D = [1, 5, 6, 7, 10, 11, 12, 15, 20, 22, 23, 30, 31, 32];
$E = [9, 14, 17, 21, 25, 26, 27, 29, 34, 35, 37, 38];
$F = [2, 19];
$G = [8];
$H = [];
$M = [2, 14, 17, 19, 29, 32];

// 查詢集合定義
$AQ1 = [4, 17, 30];
$AQ2 = [5, 18, 31];
$AQ3 = [7, 20, 33];
$AQ4 = [13, 26];
$AQ5 = []; // 空集合，但已定義
$AQ6 = [];
$AQ7 = [];

$BQ1 = [5, 24];
$BQ2 = [9, 28];
$BQ3 = [11, 30];
$BQ4 = [13, 32];
$BQ5 = [14, 33];
$BQ6 = [16, 35];
$BQ7 = [17, 36];
$BQ8 = [];
$BQ9 = []; 
$BQ10= [];

$CQ1 = [1, 14, 27];
$CQ2 = [2, 15, 28];
$CQ3 = [3, 16, 29];
$CQ4 = [6, 19, 32];
$CQ5 = [9, 22, 35];
$CQ6 = [10, 23, 36];
$CQ7 = [11, 24, 37];

$DQ1 = [1, 20];
$DQ2 = [3, 22];
$DQ3 = [4, 23];
$DQ4 = [7, 26];
$DQ5 = [12, 31];
$DQ6 = [18, 37];
$DQ7 = [19, 38];
$DQ8 = [];
$DQ9 = [];
$DQ10= []; // 修正：變數名稱從 
$DQ11= []; // 修正：

// 資料庫連接參數

//echo "test 1";
//	exit;

$servername = "localhost";
$username = "root";
$password = "bb012345CHEN$&";
$dbname = "daanchen_db";

// 檢查數字在各範圍的分布
function checkRangeCount($numbers) {
    $ranges = [0=>0, 1=>0, 2=>0, 3=>0];
    foreach($numbers as $num) {
        if($num <= 9) $ranges[0]++;
        elseif($num <= 19) $ranges[1]++;
        elseif($num <= 29) $ranges[2]++;
        else $ranges[3]++;
    }
    return max($ranges) <= 3;
}

// 檢查數字的個位數模式
function checkUnits($numbers) {
    $units = array_map(function($n){return $n%10;}, $numbers);
    $unit_counts = array_count_values($units);
    $same_units = array_filter($unit_counts, function($count){return $count > 1;});
    if(count($same_units) != 1 || max($same_units) != 2) return false;
    
    $sorted_units = array_unique($units);
    sort($sorted_units);
    $consecutive = 0;
    for($i = 1; $i < count($sorted_units); $i++) {
        if($sorted_units[$i] == $sorted_units[$i-1] + 1) $consecutive++;
    }
    return $consecutive == 2 || $consecutive == 3;
}

// 檢查與指定集合的交集數量
function checkSets($numbers, $sets) {
    $count = 0;
    foreach($sets as $set) {
        if(!empty($set) && count(array_intersect($numbers, $set)) > 0) $count++;
    }
    return $count;
}



$tests = 0;
$max_tests = 783579;

while($tests < $max_tests) {
    $tests++;
    
    // 產生數字組合============ 1
    $numbers = [];
    //$numbers[] = $C[array_rand($C)];
    //$numbers[] = $D[array_rand($D)];
    //$numbers[] = $E[array_rand($E)];
    //$numbers[] = $D[array_rand($D)];
    //$numbers[] = $F[array_rand($F)];
		$numbers[] = rand(1, 38);
		$numbers[] = rand(1, 38);
		$numbers[] = rand(1, 38);
		$numbers[] = rand(1, 38);
		$numbers[] = rand(1, 38);
    $numbers[] = rand(1, 38);
    
    
    $numbers = array_unique($numbers);
    if(count($numbers) != 6) continue;
    sort($numbers);
    
    if($numbers[5] >= 39 || !checkRangeCount($numbers) || !checkUnits($numbers)) continue;
    
    // 檢查數字在各集合中的分類
    $N = array_fill(0, 6, -1); // 初始化N陣列
    foreach($numbers as $i => $num) {
        if(in_array($num, $GLOBALS['C'])) $N[$i] = 0;
        elseif(in_array($num, $GLOBALS['D'])) $N[$i] = 1;
        elseif(in_array($num, $GLOBALS['E'])) $N[$i] = 2;
        elseif(in_array($num, $GLOBALS['F'])) $N[$i] = 3;
        elseif(in_array($num, $GLOBALS['G'])) $N[$i] = 4;
        elseif(in_array($num, $GLOBALS['H'])) $N[$i] = 5; // 新增對 H 集合的檢查
    }
    
    // 檢查位置條件==========2
		//$N[0] != 1
		//include 'var886.php';
		
    //if($N[0] != $Xno1 || $N[1] != $Xno2 || $N[2] != $Xno3 || $N[3] != $Xno4 || $N[4] != $Xno5 || $N[5] != $Xno6) continue;
     $rno=rand(0,1);
		 
		 if($N[0] != $rno) continue;
		
    // 計算與各查詢集的交集數========3
    $NAQ = checkSets($numbers, [$AQ1, $AQ2, $AQ3, $AQ4, $AQ5, $AQ6, $AQ7]);
    $NBQ = checkSets($numbers, [$BQ1, $BQ2, $BQ3, $BQ4, $BQ5, $BQ6, $BQ7, $BQ8, $BQ9, $BQ10]);
    $NCQ = checkSets($numbers, [$CQ1, $CQ2, $CQ3, $CQ4, $CQ5, $CQ6, $CQ7]);
    $NDQ = checkSets($numbers, [$DQ1, $DQ2, $DQ3, $DQ4, $DQ5, $DQ6, $DQ7, $DQ8, $DQ9, $DQ10, $DQ11]);
    
    // 檢查是否符合所有條件========4
		include 'varqq.php';
		
    if($NAQ == $XAQ && $NBQ == $XBQ && $NCQ == $XCQ && $NDQ == $XDQ) {
        echo "Numbers: " . implode(", ", $numbers) . "\n";
        echo "<br>";
        echo "N1,N2,N3,N4,N5,N6: " . implode(",", $N) . "\n";
        echo "<br>";
        echo "NAQ: $NAQ, NBQ: $NBQ, NCQ: $NCQ, NDQ: $NDQ\n";
        echo "<br>";
        echo "Test count: $tests\n";
        echo "<br>";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // 修改後的 SQL 語句，包含 N0 到 N5
            $sql = "INSERT INTO newno (no1, no2, no3, no4, no5, no6, naq, nbq, ncq, ndq, nf1, nf2, nf3, nf4, nf5, nf6) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $numbers[0], $numbers[1], $numbers[2], 
                $numbers[3], $numbers[4], $numbers[5],
                $NAQ, $NBQ, $NCQ, $NDQ,
                $N[0], $N[1], $N[2], $N[3], $N[4], $N[5]
            ]);
            
            echo "資料成功儲存到資料庫！\n";
            echo "<br>";
            
        } catch(PDOException $e) {
            echo "資料庫錯誤: " . $e->getMessage() . "\n";
        } finally {
            $conn = null;
        }
        
        $end_time = microtime(true);
        echo "Time taken: " . ($end_time - $start_time) . " seconds\n";
        exit;
    }
}

echo "Test count: $tests\n";
echo "失敗\n";
$end_time = microtime(true);
echo "Time taken: " . ($end_time - $start_time) . " seconds\n";
?>