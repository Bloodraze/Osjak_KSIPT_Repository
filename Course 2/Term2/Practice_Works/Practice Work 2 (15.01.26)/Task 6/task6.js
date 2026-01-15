let first = 5;
let plus = 2;
let goal = 250; 
let sum = 0;
let days = 0;
while (sum < goal) {
    days += + 1;
    let today = first + (days - 1) * plus;
    sum += today;
}
console.log(days);