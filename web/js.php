<!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
<script>
'use strict';

var m = new Map();
var s = new Set([2,3,4,5,67,75,5,'new']);

m.set('age',21);
m.set('name','codekissyoung');

console.log(m.has('name2'));
console.log(m.get('age'));

console.log(m);
console.log(s);

for(var x of s){
	console.log(x);
}

for(var x of m){
	console.log(x[0] + " : " +  x[1]);
}

m.forEach(function(value,key,map){
	console.log(value);
	console.log(key);
});

</script>
</body>
</html>

