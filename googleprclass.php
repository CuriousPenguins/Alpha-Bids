<?php
2
class GooglePageRankChecker {
3
 
4
    // Track the instance
5
    private static $instance;
6
 
7
    // Constructor
8
    function getRank($page) {
9
        // Create the instance, if one isn't created yet
10
        if(!isset(self::$instance)) {
11
            self::$instance = new self();
12
        }
13
        // Return the result
14
        return self::$instance->check($page);
15
    }
16
 
17
    // Convert string to a number
18
    function stringToNumber($string, $check, $magic) {
19
        $int32 = 4294967296;  // 2^32
20
        $length = strlen($string);
21
        for ($i = 0; $i < $length; $i++) {
22
            $check *= $magic;
23
            // If the float is beyond the boundaries of integer (usually +/- 2.15e+9 = 2^31),
24
            // the result of converting to integer is undefined
25
            // refer to http://www.php.net/manual/en/language.types.integer.php
26
            if($check >= $int32) {
27
                $check = ($check - $int32 * (int) ($check / $int32));
28
                // if the check less than -2^31
29
                $check = ($check < -($int32 / 2)) ? ($check + $int32) : $check;
30
            }
31
            $check += ord($string{$i});
32
        }
33
        return $check;
34
    }
35
 
36
    // Create a url hash
37
    function createHash($string) {
38
        $check1 = $this->stringToNumber($string, 0x1505, 0x21);
39
        $check2 = $this->stringToNumber($string, 0, 0x1003F);
40
 
41
        $factor = 4;
42
        $halfFactor = $factor/2;
43
 
44
        $check1 >>= $halfFactor;
45
        $check1 = (($check1 >> $factor) & 0x3FFFFC0 ) | ($check1 & 0x3F);
46
        $check1 = (($check1 >> $factor) & 0x3FFC00 ) | ($check1 & 0x3FF);
47
        $check1 = (($check1 >> $factor) & 0x3C000 ) | ($check1 & 0x3FFF);
48
 
49
        $calc1 = (((($check1 & 0x3C0) << $factor) | ($check1 & 0x3C)) << $halfFactor ) | ($check2 & 0xF0F );
50
        $calc2 = (((($check1 & 0xFFFFC000) << $factor) | ($check1 & 0x3C00)) << 0xA) | ($check2 & 0xF0F0000);
51
 
52
        return ($calc1 | $calc2);
53
    }
54
 
55
    // Create checksum for hash
56
    function checkHash($hashNumber) {
57
        $check = 0;
58
        $flag = 0;
59
 
60
        $hashString = sprintf('%u', $hashNumber);
61
        $length = strlen($hashString);
62
 
63
        for ($i = $length - 1;  $i >= 0;  $i --) {
64
            $r = $hashString{$i};
65
            if(1 === ($flag % 2)) {
66
                $r += $r;
67
                $r = (int)($r / 10) + ($r % 10);
68
            }
69
            $check += $r;
70
            $flag ++;
71
        }
72
 
73
        $check %= 10;
74
        if(0 !== $check) {
75
            $check = 10 - $check;
76
            if(1 === ($flag % 2) ) {
77
                if(1 === ($check % 2)) {
78
                    $check += 9;
79
                }
80
                $check >>= 1;
81
            }
82
        }
83
        return '7'.$check.$hashString;
84
    }
85
 
86
    function check($page) {
87
 
88
        // Open a socket to the toolbarqueries address, used by Google Toolbar
89
        $socket = fsockopen("toolbarqueries.google.com", 80, $errno, $errstr, 30);
90
 
91
        // If a connection can be established
92
        if($socket) {
93
            // Prep socket headers
94
            $out = "GET /tbr?client=navclient-auto&ch=".$this->checkHash($this->createHash($page)).
95
              "&features=Rank&q=info:".$page."&num=100&filter=0 HTTP/1.1\r\n";
96
            $out .= "Host: toolbarqueries.google.com\r\n";
97
            $out .= "User-Agent: Mozilla/4.0 (compatible; GoogleToolbar 2.0.114-big; Windows XP 5.1)\r\n";
98
            $out .= "Connection: Close\r\n\r\n";
99
 
100
            // Write settings to the socket
101
            fwrite($socket, $out);
102
 
103
            // When a response is received...
104
            $result = "";
105
            while(!feof($socket)) {
106
                $data = fgets($socket, 128);
107
                $pos = strpos($data, "Rank_");
108
                if($pos !== false){
109
                    $pagerank = substr($data, $pos + 9);
110
                    $result += $pagerank;
111
                }
112
            }
113
            // Close the connection
114
            fclose($socket);
115
 
116
            // Return the rank!
117
            return $result;
118
        }
119
    }
120
}
121
?>