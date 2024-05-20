import { jwtDecode } from "jwt-decode";

const token = localStorage.getItem('token');
//Atribui valor apenas se existir um token em localstorage
const decoded = !!token ? jwtDecode(token): false;
//Hora do Unix 
const UnixTimeNow = Math.floor(Date.now() / 1000);
//Verifica se a hora atual é maior ou menor que a hora de expiração
const isValid = decoded.exp > UnixTimeNow;
if(!isValid) localStorage.removeItem('token');
//Se o token existir e for valido, Autenticado = true;
export const isAuth = !!token && isValid ? true : false;

//Somente para usuários autenticados
export function AuthOnlyRoute(to,from,next){
    if(isAuth) return next();
    else return next('login');
}
//Somente para usuários não autenticados
export function AnonymousOnlyRoute(to,from, next){
    if(isAuth) return next('');
    else return next();
}