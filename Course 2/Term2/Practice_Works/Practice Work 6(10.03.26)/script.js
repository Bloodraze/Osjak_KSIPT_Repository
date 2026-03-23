//ЗАДАНИЕ 1
const numbersTask1 = [1, 2, 3, 4, 5];
const doubled = numbersTask1.map(function(num) {
  return num * 2;
});
console.log(doubled);

//ЗАДАНИЕ 2
const numbersTask2 = [1, 2, 3, 4, 5];
const result = [
  numbersTask2.reduce(function(sum, num) {
    return sum + num;
  }, 0),
  numbersTask2.reduce(function(prod, num) {
    return prod * num;
  }, 1)
];
console.log(result);

//ЗАДАНИЕ 3
const proverbs = ['Программист', 'пишущий', 'без', 'циклов'];
const totalLength = proverbs.reduce(function(total, str) {
  return total + str.length;
}, 0);
console.log(totalLength);

//ЗАДАНИЕ 4
console.log('xxxxx');
console.log('xxxx');
console.log('xxx');
console.log('xx');
console.log('x');

//ЗАДАНИЕ 5
const users = [
  { id: 1, name: 'Анна', age: 25 },
  { id: 2, name: 'Иван', age: 30 },
  { id: 3, name: 'Мария', age: 17 },
  { id: 4, name: 'Петр', age: 15 }
];
const adultNames = users
  .filter(function(user) {
    return user.age >= 18;
  })
  .map(function(user) {
    return user.name;
  });
console.log(adultNames);

//ЗАДАНИЕ 6
const usersTask6 = [
  { id: 1, name: 'Анна', age: 25 },
  { id: 2, name: 'Иван', age: 30 },
  { id: 3, name: 'Мария', age: 17 },
  { id: 4, name: 'Петр', age: 15 }
];
function find(id) {
  return usersTask6.find(function(user) {
    return user.id === id;
  });
}
const user = find(3);
console.log(user);