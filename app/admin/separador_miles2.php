<input type="text" class="form-control" name="precio_venta_producto_formateado" id="precio_venta_producto_formateado" min='0' onkeyup="formateador_valor(this, this.value.charAt(this.value.length-1), 0)" value="" placeholder="" required>
<input type="text" name="precio_venta_producto" id="precio_venta_producto" min='0' value="" placeholder="" required>

<script type="text/javascript">
function formateador_valor(donde, caracter, campo) {
var decimales = false
dec = campo
pat = /[\*,\+,\(,\),\?,\\,\$,\[,\],\^]/
valor = donde.value
largo = valor.length
crtr = true

if(isNaN(caracter) || pat.test(caracter) == true) {
	if (pat.test(caracter)==true) { 
		caracter = "\\" + caracter 
	}
	carcter = new RegExp(caracter,"g")
	valor = valor.replace(carcter,"")
	donde.value = valor
	crtr = false
} else {
	var nums = new Array()
	cont = 0
	for(m=0;m<largo;m++) {
		if(valor.charAt(m) == "." || valor.charAt(m) == " " || valor.charAt(m) == ",") { 
			continue;
		} else {
			nums[cont] = valor.charAt(m)
			cont++
		}
	}
	valor_no_formateado = valor.replace('.',"")
	console.log("valor_no_formateado = "+valor_no_formateado);
	document.getElementById('precio_venta_producto').value = valor_no_formateado;
}

if(decimales == true) {
	ctdd = eval(1 + dec);
	nmrs = 1
	}
else {
	ctdd = 1; nmrs = 3
	}
var cad1="",cad2="",cad3="",tres=0
if(largo > nmrs && crtr == true)
	{
	for (k=nums.length-ctdd;k>=0;k--){
		cad1 = nums[k]
		cad2 = cad1 + cad2
		tres++
		if((tres%3) == 0){
			if(k!=0){
				cad2 = "." + cad2
				}
			}
		}
		
	for (dd = dec; dd > 0; dd--)	
	{cad3 += nums[nums.length-dd] }
	if(decimales == true)
	{cad2 += "," + cad3}
	 donde.value = cad2
	}
donde.focus()
}	
</script>