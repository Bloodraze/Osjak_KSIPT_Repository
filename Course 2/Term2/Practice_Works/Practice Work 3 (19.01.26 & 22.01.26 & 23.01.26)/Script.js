//ЗАДАНИЕ 1
console.log('Задание 1:');
let euroRate = 74;
let dollarRate = 63;
let euroAmount = 500;
let dollarAmount = 2500;
let rublesAmount = euroAmount * euroRate + dollarAmount * dollarRate;
console.log(rublesAmount);

//ЗАДАНИЕ 2
console.log('Задание 2:');
let travelCost = 150000;
let balance = 100000;
let debtAmount = (travelCost - balance) * 2;
console.log(debtAmount);

//ЗАДАНИЕ 3
console.log('Задание 3:');
let flightDistance = 7260;
let avrgSpeed = 600;
let flightTime = Math.round(flightDistance / avrgSpeed);
console.log(flightTime);

//ЗАДАНИЕ 4
console.log('Задание 4:');
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
console.log(ageGroup);

//ЗАДАНИЕ 5
console.log('Задание 5:');
let weight = 5;
let rec;
if (weight < 4) {
  rec = 'Пора перекусить';
  console.log(rec);
} else if (weight >= 4 && weight <= 5.5) {
  rec = 'Вес в норме';
  console.log(rec);
} else if (weight > 5.5) {
  rec = 'Пора на тренировку';
  console.log(rec);
}

//ЗАДАНИЕ 6
console.log('Задание 6:');
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
console.log('Доп. Задание:');
const readline = require('readline-sync');
const a = readline.question('a: ');
const b = readline.question('b: ');
const c = readline.question('c: ');
const m = readline.question('m: ');
const n = readline.question('n: ');
if (a * m * m + b * m + c == n) {
    console.log('Да, пройдет');
} else {
    console.log('Нет, не пройдет');
}

//ЗАДАНИЕ 7
console.log('Задание 7:');
const StartNumber = 1;
const multiplier = 4;
const quantity = 7;
let current = StartNumber;
for (let i = 0; i < quantity; i = i + 1) {
  console.log(current);
  current *= multiplier;
}

//ЗАДАНИЕ 8
console.log('Задание 8: ');
const lastNumber = 10;
let sum = 0;
for (let i = 1; i <= lastNumber; i++) {
  sum += i;
}
console.log(sum);

//ЗАДАНИЕ 9
console.log('Задание 9: ')
const LastNumber = 5;
let Result = 1;
for (let i = 1; i <= LastNumber; i++) {
  if (i % 2 === 0) {
    Result *= i;
  }
}
console.log(Result);

//ЗАДАНИЕ 10
console.log('Задание 10: ');
let num = 15;
for (let i = 2; i < number; i++) {
  if (num % i === 0) { 
    console.log(i);
  }
}

//ЗАДАНИЕ 11
console.log('Задание 11: ');
const readline = require('readline-sync');
const k = Number(readline.question('a: ')); // или +readline.question('a: ')
for (let num = 100; num <= 999; num++) {
  let a = (num / 100) | 0;
  let b = (num / 10) % 10 | 0; 
  let c = num % 10; 
  let sum = a + b + c;
  if (sum === k) {
    console.log(num);
  }
}