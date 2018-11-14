function quickView(id) {
	imgSrc = $(".imgPro_"+id).attr('src');
	$("#quickview-wrapper #imgPreview").first().attr('src', imgSrc);

	txtPro = $(".txtPro_"+id).first().text();
	$("#txtNameProduct").text(txtPro);

	txtPrice = $(".txtPrice_"+id).first().text();
	$("#txtprice").text(txtPrice);

	txtPriceSales = $(".txtPriceSales_"+id).first().text();
	$("#txtPriceSales").text(txtPriceSales);

	description = $(".description_"+id).first().text();
	$("#txtDescription").text(description);

	
}