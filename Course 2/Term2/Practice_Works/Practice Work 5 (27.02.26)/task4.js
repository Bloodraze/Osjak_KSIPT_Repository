//ЗАДАНИЕ 1
class Animal {
  eat() {
    console.log('Животное есть');
  }
}
class Bear extends Animal {
  constructor(weight) {
    super();
    this.weight = weight;
  }
  run(speed) {
    console.log('Медведь бежит со скоростью ' + speed);
  }
}
const bear = new Bear(300);
console.log(bear);
bear.run(20);
bear.eat();

//ЗАДАНИЕ 2
class Shape {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }
  move(dx, dy) {
    this.x += dx;
    this.y += dy;
    console.log('Фигура переместилась.');
  }
}
class Square extends Shape {
  constructor(x, y, size) {
    super(x, y);
    this.size = size;
  }
}
class Rectangle extends Shape {
  constructor(x, y, width, height) {
    super(x, y);
    this.width = width;
    this.height = height;
  }
  perimeter() {
    return (this.width + this.height) * 2;
  }
}
const rect = new Rectangle(0, 0, 10, 5);
console.log(rect.perimeter());
class Square2 extends Rectangle {
  constructor(x, y, size) {
    super(x, y, size, size);
  }
}
const square = new Square2(0, 0, 4);
console.log(square.perimeter());
class Circle extends Shape {
  constructor(x, y, radius) {
    super(x, y);
    this.radius = radius;
  }
  area() {
    return Math.PI * this.radius * this.radius;
  }
}
const circle = new Circle(0, 0, 5);
console.log(circle.area());