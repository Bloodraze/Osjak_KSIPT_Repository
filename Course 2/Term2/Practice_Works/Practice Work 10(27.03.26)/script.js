const canvas = document.querySelector('#canvas');
const ctx = canvas.getContext('2d');
const size = 500;
const padding = 50;
const startX = (canvas.width - size)/2;
const startY = (canvas.height - size)/2;
ctx.fillStyle = "white";
ctx.fillRect(startX, startY, size, size);

function DrawRotatedRect(x, y, w, h, angle, color){
    ctx.save();
    ctx.translate(x+w/2, y+h/2);
    ctx.rotate(angle*Math.PI/180);
    ctx.fillStyle = color;
    ctx.fillRect(-w/2, -h/2, w, h);
    ctx.restore();
}

const subSize = 180;
const gap = 40;

//ЛЕВЫЙ ВЕРХНИЙ
const q1X = startX + gap;
const q1Y = startY + gap;
const smallS = 45;
ctx.fillStyle = 'black';
ctx.fillRect(q1X+20, q1Y+20, smallS, smallS);
ctx.fillRect(q1X+75, q1Y+20, smallS, smallS);
ctx.fillRect(q1X+20, q1Y+75, smallS, smallS);
ctx.fillRect(q1X+75, q1Y+75, smallS, smallS);
ctx.fillRect(q1X-35, q1Y+50, smallS, smallS);
ctx.fillRect(q1X+130, q1Y+50, smallS, smallS);

//ПРАВЫЙ ВЕРХНИЙ
const q2X = startX+size-subSize-gap;
const q2Y = startY+gap;
ctx.fillStyle = 'black';
ctx.fillRect(q2X, q2Y, subSize, subSize);
DrawRotatedRect(q2X+35, q2Y+35, 110, 110, 45, 'white');
DrawRotatedRect(q2X+55, q2Y+55, 70, 70, 45, 'black');

//ЛЕВЫЙ НИЖНИЙ
const q3X = startX+gap;
const q3Y = startY+size-subSize-gap;
ctx.fillStyle = 'black';
ctx.fillRect(q3X, q3Y, subSize, subSize);
ctx.save();
ctx.beginPath();
ctx.rect(q3X, q3Y, subSize, subSize);
ctx.clip();
DrawRotatedRect(q3X+40, q3Y+30, 100, 100, 45, 'white');
DrawRotatedRect(q3X+70, q3Y+90, 80, 80, 45, 'black');
ctx.restore();

//ПРАВЫЙ НИЖНИЙ
const q4X = startX+size-subSize-gap;
const q4Y = startY+size-subSize-gap;
ctx.fillStyle = 'black';
ctx.fillRect(q4X, q4Y, subSize, subSize);
for(let i=0; i<4; i++){
    DrawRotatedRect(q4X+10+(i*35), q4Y+30+(i*25), 40, 40, 20, 'white');
    DrawRotatedRect(q4X+14+(i*35), q4Y+34+(i*25), 32, 32, 20, 'black');
}