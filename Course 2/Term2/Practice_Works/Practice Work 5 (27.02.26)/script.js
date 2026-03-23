// Задание 1
let animalsData = [
    ['волк', 50, 'мясо'],
    ['лиса', 40, 'грызуны'], 
    ['медведь', 45, 'растения, мясо'],
    ['заяц', 50, 'трава'],
    ['олень', 60, 'трава, листья']
];
function createAnimal(name, speed, food) {
    return {
        name: name,
        speed: speed,
        food: food,
        run: function() {
            console.log(this.name + ' бежит со скоростью ' + this.speed + ' км/ч');
        },
        eat: function() {
            console.log(this.name + ' ест ' + this.food);
        }
    };
}
let animals = [];
for (let i = 0; i < animalsData.length; i++) {
    let animal = createAnimal(animalsData[i][0], animalsData[i][1], animalsData[i][2]);
    animals.push(animal);
}
console.log('Объекты животных:');
for (let i = 0; i < animals.length; i++) {
    console.log(animals[i]);
}
console.log('\nМетоды run() и eat():');
for (let i = 0; i < animals.length; i++) {
    animals[i].run();
    animals[i].eat();
    console.log('---');
}

// Задание 2
function Calculator() {
    this.a = 0;
    this.b = 0;
    this.read = function() {
        const readline = require('readline');
        const rl = readline.createInterface({
            input: process.stdin,
            output: process.stdout
        });
        return new Promise((resolve) => {
            rl.question('Первое число: ', (num1) => {
                rl.question('Второе число: ', (num2) => {
                    this.a = Number(num1);
                    this.b = Number(num2);
                    rl.close();
                    resolve();
                });
            });
        });
    };
    this.sum = function() {
        return this.a + this.b;
    };
    this.mul = function() {
        return this.a * this.b;
    };
    this.pow = function() {
        let result = 1;
        for (let i = 0; i < this.b; i++) {
            result = result * this.a;
        }
        return result;
    };
}
async function runCalculator() {
    let calc = new Calculator();
    await calc.read();
    console.log('Сумма = ' + calc.sum());
    console.log('Произведение = ' + calc.mul()); 
    console.log('Степень = ' + calc.pow());
}
runCalculator();
function Ladder() {
    this.step = 0;
    this.up = function(n) {
        this.step = this.step + n;
    };
    this.down = function(n) {
        if (this.step - n < 0) {
            this.step = 0;
        } else {
            this.step = this.step - n;
        }
    };
    this.showStep = function() {
        console.log('Текущая ступенька: ' + this.step);
    };
}
let ladder1 = new Ladder();
ladder1.showStep();
ladder1.up(2);
ladder1.up(3);
ladder1.showStep();
ladder1.down(4);
ladder1.showStep();