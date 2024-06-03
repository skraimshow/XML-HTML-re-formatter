<?php

function formatXML($unStructuredData) {
    $tokens = preg_split('/(<[^>]+>)/', $unStructuredData, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    
    $formattedXML = "";
    $indentLevel = 0;
    $indentSize = 2;
    
    foreach ($tokens as $token) {
        $token = trim($token);
        if (empty($token)) {
            continue;
        }
        
        if ($token[0] == '<') {
            if ($token[1] == '/') {
                $indentLevel--;
                $formattedXML .= str_repeat(" ", $indentLevel * $indentSize) . $token . "\n";
            } elseif ($token[strlen($token) - 2] == '/') {
                $formattedXML .= str_repeat(" ", $indentLevel * $indentSize) . $token . "\n";
            } else {
                $formattedXML .= str_repeat(" ", $indentLevel * $indentSize) . $token . "\n";
                $indentLevel++;
            }
        } else {
            $formattedXML .= str_repeat(" ", $indentLevel * $indentSize) . $token . "\n";
        }
    }
    
    return $formattedXML;
}

echo "Enter a XML/HTML: ";
$unStructuredData = trim(fgets(STDIN));

$formattedXML = formatXML($unStructuredData);

echo "----------------------------", "\n";
echo $formattedXML;
echo "----------------------------";
?>
