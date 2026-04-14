function factorial(n){
    if(n==1){
        return 1;
    }
    return n * factorial(n-1)
}

let n = 5;

console.log(factorial(n))

function fibonacci0(nF) {
    if(nF<= 1) {
        return nF;
    }
    return fibonacci0(nF-1) + fibonacci0(nF-2);
}

function fibonacci1(nF) {
    if(nF<= 2) {
        return 1;
    }
    return fibonacci1(nF-1) + fibonacci1(nF-2);
}

let nF = 5;

console.log("fibonacci0:", fibonacci0(nF));
console.log("fibonacci1:", fibonacci1(nF));