class Shape {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }
  perimeter() {
    return null;
  }
  area() {
    return null;
  }
  toString() {
    return `Shape at (${this.x}, ${this.y})`;
  }
  move(dx, dy) {
    this.x += dx;
    this.y += dy;
    console.log('Фигура переместилась.');
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
  area() {
    return this.width * this.height;
  }
  toString() {
    return `Rectangle(${this.width}x${this.height}) at (${this.x}, ${this.y})`;
  }
}
class Square extends Rectangle {
  constructor(x, y, size) {
    super(x, y, size, size);
  }
  toString() {
    return `Square(${this.size}x${this.size}) at (${this.x}, ${this.y})`;
  }
}
class Circle extends Shape {
  constructor(x, y, radius) {
    super(x, y);
    this.radius = radius;
    this.PI = 3.1416;
  }
  perimeter() {
    return 2 * this.PI * this.radius;
  }
  area() {
    return this.PI * this.radius * this.radius;
  }
  toString() {
    return `Circle(r=${this.radius}) at (${this.x}, ${this.y})`;
  }
}
class Triangle extends Shape {
  #a;
  #b;
  #c;
  constructor(x, y, a, b, c) {
    super(x, y);
    this.#a = a;
    this.#b = b;
    this.#c = c;
  }
  perimeter() {
    return this.#a + this.#b + this.#c;
  }

  area() {
    return (this.#a * this.#b) / 2;
  }
  toString() {
    return `Triangle(${this.#a}, ${this.#b}, ${this.#c}) at (${this.x}, ${this.y})`;
  }
}
const rect = new Rectangle(0, 0, 10, 5);
const square = new Square(0, 0, 4);
const circle = new Circle(0, 0, 5);
const triangle = new Triangle(0, 0, 3, 4, 5);
const shapes = [rect, square, circle, triangle];
shapes.forEach((shape, index) => {
  console.log(`${index + 1}. ${shape.toString()}`);
  console.log(`   Периметр: ${shape.perimeter()}`);
  console.log(`   Площадь: ${shape.area()}`);
  console.log('');
});
const shape = new Shape(1, 2);
console.log('Shape test:');
console.log(shape.toString());
console.log(`Периметр: ${shape.perimeter()}`);
console.log(`Площадь: ${shape.area()}`);