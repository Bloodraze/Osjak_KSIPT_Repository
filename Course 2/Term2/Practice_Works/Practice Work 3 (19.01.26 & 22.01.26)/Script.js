//ЗАДАНИЕ 1
let euroRate = 74;
let dollarRate = 63;
let euroAmount = 500;
let dollarAmount = 2500;
let rublesAmount = euroAmount * euroRate + dollarAmount * dollarRate;
console.log(rublesAmount);

//ЗАДАНИЕ 2
let travelCost = 150000;
let balance = 100000;
let debtAmount = (travelCost - balance) * 2;
console.log(debtAmount);

//ЗАДАНИЕ 3
let flightDistance = 7260;
let avrgSpeed = 600;
let flightTime = Math.round(flightDistance / avrgSpeed);
console.log(flightTime);

//ЗАДАНИЕ 4
let age = 5;
let ageGroup;
if (age <= 1) {
  ageGroup = 'Котята';
} else if (age > 1 && age <= 3) {
  ageGroup = 'Молодые коты';
} else if (age > 3 && age <= 7) {
  ageGroup = 'Коты средних лет';
} else if (age > 7) {
  ageGroup = 'Почтенные коты';
}

//ЗАДАНИЕ 5
let weight = 5;
let rec;
if (weight < 4) {
  rec = 'Пора перекусить';
} else if (weight >= 4 && weight <= 5.5) {
  recommendation = 'Вес в норме';
} else if (weight > 5.5) {
  rec = 'Пора на тренировку';
}

//ЗАДАНИЕ 6
let number = 15;
let taskResult;
if (number % 3 === 0 && number % 5 === 0) {
    taskResult = 'FizzBuzz';
} else if (number % 3 === 0) {
    taskResult = 'Fizz';
} else if (number % 5 === 0) {
    taskResult = 'Buzz';
} else {
    taskResult = number;
}
console.log(taskResult);
//ДОП. ЗАДАНИЕ
const readline = require('readline-sync');
var a = readline.question('a: ');
var b = readline.question('b: ');
var c = readline.question('c: ');
var m = readline.question('m: ');
var n = readline.question('n: ');
if (a * m * m + b * m + c == n) {
    console.log('Да, пройдет');
} else {
    console.log('Нет, не пройдет');
}