function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
  }
  
  function execmascara(){
    v_obj.value=v_fun(v_obj.value)
  }
  
  function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
  }
  
  String.prototype.normalize = function()
     {
        try{return    this.match(/[a-zA-Z0-9]/g).join('');}
        catch(err){return this}
     }
  
  
  function monetaryMask(e, decimal, tamanho,negative)  {
    if (!decimal) decimal = 2; 
    if (!tamanho) tamanho = 16; 
    if (!negative) negative = 0;
    var sinal = "";
    if(e.keyCode == 9 || e.keyCode == 116) return true; // TAB
    
    var ISIE = /MSIE/.test(navigator.userAgent);
        
    switch(String.fromCharCode(e.keyCode)) {
      case 'a':case '1': key = 1; break;
      case 'b':case '2': key = 2; break;
      case 'c':case '3': key = 3; break;
      case 'd':case '4': key = 4; break;
      case 'e':case '5': key = 5; break;
      case 'f':case '6': key = 6; break;
      case 'g':case '7': key = 7; break;
      case 'h':case '8': key = 8; break;
      case 'i':case '9': key = 9; break;
      case '`':case '0': key = 0; break;
      default : String.fromCharCode(e.keyCode);
    }
        
    t = (!ISIE) ? e.currentTarget : e.srcElement;
    
    if(!parseInt(t.value.normalize())) { 
      t.onclick = function() {   
        if(!ISIE) {
          t.selectionStart = t.value.length;
          t.selectionEnd  = t.value.length;
        }
        else {
          var range = t.createTextRange();
          range.moveStart("character", t.value.length);
          range.moveEnd("character", 1);
          range.select();
        }   
      }
      t.onselect = t.onfocus;
    }
    if(negative)
    {
      sinal = t.value.substr(0,1);
      if(e.keyCode==109 || e.keyCode==173)// Verifica se é digitado o sinal de menos
      {
          //alert("entrou");
          if(sinal!="-")
          {
            t.value = "-"+t.value;
          }
  
      }
      else if(e.keyCode==107 || e.keyCode==61) // Verifica se é digitado o sinal de mais
      {
         t.value = t.value.replace("-","");
      }
      if(sinal!="-")
      {
        sinal = "";
      }
    }
    if((e.keyCode > 105 || e.keyCode < 48 || (e.keyCode > 57 && e.keyCode < 96)) && e.keyCode != 8)
      try{e.preventDefault();}catch(err){e.returnValue = false}
    else {
      str = (e.keyCode == 8) ? t.value.substr(0,t.value.length-1) : t.value+key.toString();
  
      var v = parseFloat(str.normalize()).toString();
      v = v.substr(0,tamanho);
      var x = parseFloat(v).toString();
  
      var milhares = 10;
      for (i=1; i < (decimal); i++) {
        milhares = milhares * 10;
      }  
  
      if (x.length <= decimal) {
        var zeros = '';
        for (i=0; i < (decimal - x.length); i++) {
          zeros = zeros + '0';
        }
      }
  
      if(parseFloat(str.normalize()) < milhares) { //parte decimal
        t.value = '0,'+zeros+x;
      }
      else { //maior que decimal
        var decimal = x.substr(x.length-decimal);
        var inteiro = Math.floor(v/milhares);
        t.value = sinal+parteInteira(inteiro) + ',' + decimal;
      }
  
        try{
          e.preventDefault();
        }
        catch(err){e.returnValue = false}
      }
  }    
  
     
  function soNumeros(v){
    return v.replace(/\D/g,"")
  }
  
  function datapt(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que n&ccedil;o &ccedil; d&ccedil;gito
    v=v.replace(/(\d{2})(\d)/,"$1/$2")    //Coloca h&ccedil;fen entre o quarto e o quinto d&ccedil;gitos
    v=v.replace(/(\d{2})(\d)/,"$1/$2")    //Coloca h&ccedil;fen entre o quarto e o quinto d&ccedil;gitos
    return v
  }
  
  
  function mValor(v){ 
    v=v.replace(/\D/g,"") //Remove tudo o que nÃ£o Ã© dÃ­gito
    v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1,$2");
    //v=v.replace(/(\d{3})(\d)/g,"$1.$2")
    v=v.replace(/(\d)(\d{2})$/,"$1,$2") //Coloca ponto antes dos 2 Ãºltimos digitos
    return v
  }
  
  function mValorPercentual(v){ //2 casas decimais
    v=v.replace(/\D/g,"") //Remove tudo o que nÃ£o Ã© dÃ­gito
    v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1,$2");
    v=v.replace(/(\d)(\d{2})$/,"$1,$2") //Coloca ponto antes dos 2 Ãºltimos digitos*/
    return v
  }
  
  
  function mMoeda(v){
    v=v.replace(/\D/g,"") // permite digitar apenas numero
    v=v.replace(/(\d{1})(\d{15})$/,"$1.$2") // coloca ponto antes dos ultimos digitos
    v=v.replace(/(\d{1})(\d{11})$/,"$1.$2") // coloca ponto antes dos ultimos 11 digitos
    v=v.replace(/(\d{1})(\d{8})$/,"$1.$2") // coloca ponto antes dos ultimos 8 digitos
    v=v.replace(/(\d{1})(\d{5})$/,"$1.$2") // coloca ponto antes dos ultimos 5 digitos
    v=v.replace(/(\d{1})(\d{2})$/,"$1,$2") // coloca virgula antes dos ultimos 2 digitos
  return v;
  } 
  
  