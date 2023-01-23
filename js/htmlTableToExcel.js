function htmlTableToExcel(type){
 var data = document.getElementById('tblToExcl');
 var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
 XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
 XLSX.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel' + type);
}