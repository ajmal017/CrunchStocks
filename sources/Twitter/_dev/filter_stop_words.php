<?php
$stopWords=['he', 'through', 'haven', 'this', 'what', 'are', 'same', 'ourselves', 'was', 'too', 'against', 'again', 'his', 'wouldn', 'herself', 'him', 'now', 're', 'has', 'into', 'while', 'yours', 'their', 'shouldn', 'most', 'my', 'yourselves', 've', 'until', 'above', 'she', 'for', 'where', 'any', 't', 'each', 'you', 'isn', 'couldn', 'only', 'should', 'there', 'o', 'once', 'some', 'with', 'over', 'can', 'our', 'won', 'few', 'is', 'out', 'here', 'not', 'do', 'doing', 'from', 'y', 'its', 'as', 'it', 'hasn', 'on', 'had', 'no', 's', 'they', 'to', 'whom', 'how', 'other', 'having', 'then', 'an', 'just', 'shan', 'were', 'd', 'mustn', 'nor', 'which', 'have', 'off', 'after', 'itself', 'up', 'than', 'll', 'does', 'under', 'himself', 'in', 'both', 'when', 'the', 'didn', 'that', 'doesn', 'themselves', 'at', 'by', 'very', 'myself', 'a', 'why', 'yourself', 'who', 'them', 'those', 'about', 'her', 'such', 'and', 'ma', 'mightn', 'me', 'am', 'because', 'needn', 'i', 'wasn', 'theirs', 'don', 'if', 'being', 'between', 'so', 'aren', 'below', 'm', 'ain', 'or', 'we', 'these', 'during', 'own', 'your', 'before', 'been', 'down', 'of', 'weren', 'but', 'hers', 'be', 'all', 'did', 'ours', 'further', 'will', 'hadn', 'more'];

$example_sentence="This is an example showing off stop word filtration.";
	echo "<h1>Example Sentence:</h1>".$example_sentence."<br><br>";

$tokenized=['This', 'is', 'an', 'example', 'showing', 'off', 'stop', 'word', 'filtration'];

echo "<h1>Result:</h1><pre>";
	print_r(array_diff($tokenized, $stopWords));
echo "</pre>";

echo "<br><br>";

echo "<h1>Should be:</h1><pre>";
	print_r(['This', 'example', 'showing', 'stop', 'word', 'filtration']);
echo "</pre>";
?>