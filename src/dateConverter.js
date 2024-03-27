function DateConvert(str){
const date = new Date(str);

var options = {year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric'};

return date.toLocaleDateString('pt-BR', options);}