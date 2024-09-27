let documento = "123456789";
let nombre = "Leinad";
let edad = 21;
let esEstudiante = true;

console.log(nombre);
console.log(edad);
console.log(esEstudiante);

//array
let arreglo = ["jose","martin","heidegger"];
let arreglo2 = [1,2,3,4,5,6,7,8,9];
console.log(arreglo);
console.log(arreglo2);
//object
let objeto = {
    nombre:"leinad",
    edad:21,
    esEstudiante:true,
}
console.log(objeto);

// 2 variables numericas
let a = 10;
let b = 5;
let suma = a + b;
console.log(suma);

//resta

let resta = a - b;
console.log(resta);

//multiplicación
let multi = a * b;
console.log(multi);
//division
let div = a / b;
console.log(div);

//comparación
console.log( "El numero ", + a + " es estrictamente igual " + " a ", + b,":", + a===b);
console.log( "El numero ", + a + " es distinto " + " a ", + b,":", + a!=b);
console.log( "El numero ", + a + " es mayor " + " a ", + b,":", + a>b);
console.log( "El numero ", + a + " es menor " + " a ", + b,":", + a<b);
console.log( "El numero ", + a + " es mayor o igual " + " a ", + b,":", + a>=b);
console.log( "El numero ", + a + " es menor o igual " + " a ", + b,":", + a<=b);
console.log( "El numero ", + a + " es igual " + " a ", + b,":", + a==b);

//Declara dos variables booleanas
let esMayorDeEdad = true;
let tieneLicencia = false;
console.log(esMayorDeEdad);
console.log(tieneLicencia);

let mensaje = `Hola, ${nombre}.`; 
mensaje += ` Tienes ${edad} años.`;
console.log(mensaje);

 //programa que solicite al usuario ingresar su nombre, edad y si es estudiante 
 let name = prompt("¿Cuál es tu nombre?");
 let age = prompt("¿Cuántos años tienes?");
 let istEstudiante = prompt("¿Eres estudiante? (si/no)").toLowerCase() === "si";
 
 let message = "¡Hola " + name + "! ";
 
 if (age >= 18) {
     message += "Eres mayor de edad";
 } else {
     message += "Eres menor de edad";
 }
 
 if (istEstudiante) {
     message += ", y como eres estudiante, obtienes un descuento.";
 }