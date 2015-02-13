
console.log('test');
var d = new Date();
var year = d.getFullYear();
var month = d.getUTCMonth();
if (month >= 7)
	year += 1;

var dates = new Array();
dates[0] = "Spring " + year;
dates[1] = "Summer " + year;
dates[2] = "Fall " + year;
var j = 3;
for (var i = 1; i < 4; i++) {
	dates[j] = "Winter " + (year + i);
	j++;
	dates[j] = "Spring " + (year + i);
	j++;
	dates[j] = "Summer " + (year + i);
	j++;
	dates[j] = "Fall " + (year + i);
	j++;
}
dates[j] = "Later";
var select = document.getElementById("Expected Graduation");
var opt = document.createElement("option");
opt.value = "No selection";
opt.textContent = "";
select.appendChild(opt);

for (var k = 0; k < dates.length; k++) {
	var opt = document.createElement("option");
	opt.value = dates[k];
	opt.textContent = dates[k];
	select.appendChild(opt);
}
