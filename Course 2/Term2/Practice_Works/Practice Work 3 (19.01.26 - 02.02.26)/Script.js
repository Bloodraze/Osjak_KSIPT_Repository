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

//23.01.26(Циклы)
//ЗАДАНИЕ 1
console.log('Задание 7:');
const StartNumber = 1;
const multiplier = 4;
const quantity = 7;
let current = StartNumber;
for (let i = 0; i < quantity; i = i + 1) {
  console.log(current);
  current *= multiplier;
}

//ЗАДАНИЕ 2
console.log('Задание 8: ');
const lastNumber = 10;
let sum = 0;
for (let i = 1; i <= lastNumber; i++) {
  sum += i;
}
console.log(sum);

//ЗАДАНИЕ 3
console.log('Задание 9: ')
const LastNumber = 5;
let Result = 1;
for (let i = 1; i <= LastNumber; i++) {
  if (i % 2 === 0) {
    Result *= i;
  }
}
console.log(Result);

//ЗАДАНИЕ 4
console.log('Задание 10: ');
let num = 15;
for (let i = 2; i < number; i++) {
  if (num % i === 0) { 
    console.log(i);
  }
}

//ЗАДАНИЕ 5
console.log('Задание 11: ');
const readline = require('readline-sync');
const k = Number(readline.question('a: '));
for (let num = 100; num <= 999; num++) {
  let a = (num / 100) | 0;
  let b = (num / 10) % 10 | 0; 
  let c = num % 10; 
  let sum = a + b + c;
  if (sum === k) {
    console.log(num);
  }
}

//29.01.26 (Switch)
//ЗАДАНИЕ 1
console.log('Задание 1:');
const readline = require('readline-sync');
const month = readline.question('Введите число месяца(1-12): ');
switch(month.trim()){
  case '1':
    console.log("Январь");
  break;
  case '2':
    console.log("Февраль");
  break;
  case '3':
    console.log("Март");
  break;
  case '4':
    console.log("Апрель");
  break;
  case '5':
    console.log("Май");
  break;
  case '6':
    console.log("Июнь");
  break;
  case '7':
    console.log("Июль");
  break;
  case '8':
    console.log("Август");
  break;
  case '9':
    console.log("Сентябрь");
  break;
  case '10':
    console.log("Октябрь");
  break;
  case '11':
    console.log("Ноябрь");
  break;
  case '12':
    console.log("Декабрь");
  break;
}

//ЗАДАНИЕ 2
console.log('Задание 2:');
const readline = require('readline-sync');
const month1 = readline.question('Введите число месяца(1-12): ');
if(month1 = '1'){
    console.log("Январь");
}elseif(month1 = '2')
{
    console.log("Февраль");
}elseif(month1 = '3')
{
    console.log("Март");
}
elseif(month1 = '4')
{
    console.log("Апрель");
}elseif(month1 = '5')
{
    console.log("Май");
}
elseif(month1 = '6')
{
    console.log("Июнь");
}elseif(month1 = '7')
{
    console.log("Июль");
}
elseif(month1 = '8')
{
    console.log("Август");
}elseif(month1 = '9')
{
    console.log("Сентябрь");
}
elseif(month1 = '10')
{
    console.log("Октябрь");
}elseif(month1 = '11')
{
    console.log("Ноябрь");
}
elseif(month1 = '12')
{
    console.log("Декабрь");
}

//ЗАДАНИЕ 3
console.log('Задание 3:');
const readline = require('readline-sync');
const week = readline.question('Введите число месяца(1-7): ');
switch(week.trim()){
  case '1':
    console.log("7 уроков");
  break;
  case '2':
    console.log("8 уроков");
  break;
  case '3':
    console.log("5 уроков");
  break;
  case '4':
    console.log("8 уроков");
  break;
  case '5':
    console.log("8 уроков");
  break;
  case '6':
    console.log("Выходные");
  break;
  case '7':
    console.log("Выходные");
  break;
}

//ЗАДАНИЕ 4
console.log('Задание 4:');
const readline = require('readline-sync');
const lastDigit = readline.question('Введите число месяца(1-7): ');
switch(lastDigit.trim()) {
  case '0':
    console.log('Последняя цифра квадрата: 0');
    break;
  case '1':
    console.log('Последняя цифра квадрата: 1');
    break;
  case '2':
    console.log('Последняя цифра квадрата: 4');
    break;
  case '3':
    console.log('Последняя цифра квадрата: 9');
    break;
  case '4':
    console.log('Последняя цифра квадрата: 6');
    break;
  case '5':
    console.log('Последняя цифра квадрата: 5');
    break;
  case '6':
    console.log('Последняя цифра квадрата: 6');
    break;
  case '7':
    console.log('Последняя цифра квадрата: 9');
    break;
  case '8':
    console.log('Последняя цифра квадрата: 4');
    break;
  case '9':
    console.log('Последняя цифра квадрата: 1');
    break;
}

//ЗАДАНИЕ 5
console.log('Задание 4:');
const readline = require('readline-sync');
const numberStr = readline.question('Введите натуральное число: ').trim();
const length = numberStr.length;
switch(length) {
  case 1:
    console.log('Количество цифр: 1');
    break;
  case 2:
    console.log('Количество цифр: 2');
    break;
  case 3:
    console.log('Количество цифр: 3');
    break;
  case 4:
    console.log('Количество цифр: 4');
    break;
  case 5:
    console.log('Количество цифр: 5');
    break;
  case 6:
    console.log('Количество цифр: 6');
    break;
  case 7:
    console.log('Количество цифр: 7');
    break;
  case 8:
    console.log('Количество цифр: 8');
    break;
  case 9:
    console.log('Количество цифр: 9');
    break;
}

//30.01.26(Массивы)
//ЗАДАНИЕ 1
console.log('Задание 1:');
let liquids = ['вода', 'молоко', 'сок', 'чай', 'йогурт'];
let fruits = ['киви', 'банан', 'персик', 'манго', 'груша', 'ананас'];
let greens = ['мята', 'шпинат', 'руккола', 'петрушка', 'базилик'];
let chosenLiquid = 1;
let chosenFruit = 3;
let chosenGreen = 2;
let order = 'Основа — ' + liquids[chosenLiquid - 1] + ', фрукт — ' + fruits[chosenFruit - 1] + ', зелень — ' + greens[chosenGreen - 1];
console.log(order);

//ЗАДАНИЕ 2
console.log('Задание 2:');
let groceries = ['чай', 'шпроты', 'печенье', 'сахар', 'чипсы'];
let shoppingList = '';
for (let i = 0; i < groceries.length; i++) {
  if (i === 0) {
    shoppingList = groceries[i];
  } else {
    shoppingList = shoppingList + ', ' + groceries[i];
  }
}

//ДОП. ЗАДАНИЕ
console.log('Доп. Задание:');
const readline = require('readline-sync');
const N = parseInt(readline.question('Введите N: '));
let primes = new Array();
let index = 0;
for (let num = 2; num <= N; num++) {
  let isPrime = true;
  for (let d = 2; d <= num - 1; d++) {
    if (num % d === 0) {
    isPrime = false;
    break;
    }
  }
  if (isPrime) {
  primes[index] = num;
  index++;
  }
}
console.log(primes);

//02.02.26(Функции)
//ЗАДАНИЕ 1
console.log('Задание 1:');
function checkVehicle(wheels, weight) {
  if (wheels === 2 && weight < 100) {
    return 'Парковка разрешена';
  } else {
    return 'Вам здесь не место! Мяу!';
  }
}
checkVehicle(2, 80);
checkVehicle(3, 80);
checkVehicle(2, 150);

//ЗАДАНИЕ 2
console.log('Задание 2:');
function calculatePressure(density, depth) {
  var g = 9.8;
  var pressure = density * g * depth;
  return pressure;
}
calculatePressure(1000, 10);

//ЗАДАНИЕ 3
console.log('Задание 3:');
function election(arr) {
  var trueCount = 0;
  var falseCount = 0;
  for (var i = 0; i < arr.length; i++) {
    if (arr[i] === true) {
      trueCount++;
    } else {
      falseCount++;
    }
  }
  if (trueCount > falseCount) {
    return true;
  } else {
    return false;
  }
}
election([true, false, true]);
election([false, false, true]);

//ДОП. ЗАДАНИЕ
console.log('Доп. Задание:');
function isPrime(n) {
  if (n < 2) {
    return false;
  }
  for (var d = 2; d < n; d++) {
    if (n % d === 0) {
      return false;
    }
  }

  return true;
}
function nextPrime(n) {
  var k = n + 1;

  while (!isPrime(k)) {
    k++;
  }

  return k;
}

//02.02.26(Объекты)
//ЗАДАНИЕ 1
console.log('Задание 1');
let daysOfWeek = {
  'понедельник': 'monday',
  'вторник': 'tuesday',
  'среда': 'wednesday',
  'четверг': 'thursday',
  'пятница': 'friday',
  'суббота': 'saturday',
  'воскресенье': 'sunday'
};
function translate(word, dict) {
  return word + ' по-английски: ' + dict[word];
}
console.log(translate('понедельник', daysOfWeek));

//ЗАДАНИЕ 2
console.log('Задание 2');
let getStatistics = function (players) {
  let totalGoals = 0;
  for (let i = 0; i < players.length; i++) {
    totalGoals = totalGoals + players[i].goals;
  }
  for (let i = 0; i < players.length; i++) {
    let player = players[i];
    player.coefficient = player.goals * 2 + player.passes;
    player.percent = Math.round(player.goals * 100 / totalGoals);
  }
  return players;
};

//ЗАДАНИЕ 3
console.log('Задание 3');
let materialPrice = {
  'wood': 1000,
  'stone': 1500,
  'brick': 2000
};
let house = {
  rooms: 10,
  floors: 5,
  material: 'wood',
  coefficient: 10.5,
  calculateSquare: function () {
    return house.rooms * house.coefficient * house.floors;
  },
  calculatePrice: function () {
    let square = house.calculateSquare();
    let priceForMeter = materialPrice[house.material];
    return square * priceForMeter;
  }
};