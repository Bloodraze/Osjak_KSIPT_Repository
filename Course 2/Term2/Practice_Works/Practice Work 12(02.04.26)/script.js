function TextCell(text) {
  if (typeof text === 'number') {
    text = '' + text;
  }
  this.text = text ? text.split('\n') : [''];
}

TextCell.prototype.minWidth = function() {
  var max = 0;
  var text = this.text;
  for (var i = 0; i < text.length; i++) {
    if (text[i].length > max) {
      max = text[i].length;
    }
  }
  return max;
};

TextCell.prototype.minHeight = function() {
  var text = this.text;
  return text ? text.length : 1;
};

TextCell.prototype.draw = function(width, height) {
  var result = [];
  var text = this.text;
  for (var i = 0; i < height; i++) {
    var line = '';
    if (i < text.length) {
      line = text[i];
    }
    while (line.length < width) {
      line = line + ' ';
    }
    result.push(line);
  }
  return result;
};

function UnderlinedCell(text) {
  TextCell.call(this, text);
}

UnderlinedCell.prototype = Object.create(TextCell.prototype);
UnderlinedCell.prototype.constructor = UnderlinedCell;

UnderlinedCell.prototype.draw = function(width, height) {
  var result = TextCell.prototype.draw.call(this, width, height);
  result[result.length - 1] = '';
  for (var i = 0; i < width; i++) {
    result[result.length - 1] += '-';
  }
  return result;
};

function RTextCell(text) {
  TextCell.call(this, text);
}

RTextCell.prototype = Object.create(TextCell.prototype);
RTextCell.prototype.constructor = RTextCell;

RTextCell.prototype.draw = function(width, height) {
  var result = [];
  var text = this.text;
  for (var i = 0; i < height; i++) {
    var line = '';
    if (i < text.length) {
      line = text[i];
    }
    var spaces = '';
    for (var s = 0; s < width - line.length; s++) {
      spaces += ' ';
    }
    result.push(spaces + line);
  }
  return result;
};

function dataTable(data) {
  var rows = [];
  
  rows.push([
    new UnderlinedCell('name'),
    new UnderlinedCell('height'), 
    new UnderlinedCell('country')
  ]);
  
  for (var i = 0; i < data.length; i++) {
    rows.push([
      new TextCell(data[i].name),
      new RTextCell(data[i].height), 
      new TextCell(data[i].country)
    ]);
  }
  
  return rows;
}

function rowHeights(rows) {
  var heights = [];
  for (var i = 0; i < rows.length; i++) {
    var maxH = 0;
    for (var j = 0; j < 3; j++) {
      var h = rows[i][j].minHeight();
      if (h > maxH) {
        maxH = h;
      }
    }
    heights.push(maxH);
  }
  return heights;
}

function colWidths(rows) {
  var widths = [0, 0, 0];
  for (var i = 0; i < rows.length; i++) {
    for (var j = 0; j < 3; j++) {
      var w = rows[i][j].minWidth();
      if (w > widths[j]) {
        widths[j] = w;
      }
    }
  }
  return widths;
}

function drawRow(row, rowHeight, colWidths) {
  var result = [];
  for (var r = 0; r < rowHeight; r++) {
    var line = '';
    for (var c = 0; c < 3; c++) {
      line += row[c].draw(colWidths[c], rowHeight)[r] + ' ';
    }
    result.push(line);
  }
  return result;
}

function drawTable(rows) {
  var rowH = rowHeights(rows);
  var colW = colWidths(rows);
  
  var table = [];
  
  var headerLine = ' ';
  for (var i = 0; i < 3; i++) {
    for (var j = 0; j < colW[i]; j++) {
      headerLine += '-';
    }
    headerLine += ' ';
  }
  table.push(headerLine);
  
  for (var i = 0; i < rows.length; i++) {
    var rowLines = drawRow(rows[i], rowH[i], colW);
    for (var j = 0; j < rowLines.length; j++) {
      table.push(rowLines[j]);
    }
    
    var sepLine = '';
    for (var k = 0; k < 3; k++) {
      for (var m = 0; m < colW[k]; m++) {
        sepLine += '-';
      }
      sepLine += ' ';
    }
    table.push(sepLine);
  }
  
  return table.join('\n');
}

var MOUNTAINS = [
  {name: "Kilimanjaro", height: 5895, country: "Tanzania"},
  {name: "Everest", height: 8848, country: "Nepal"},
  {name: "Mount Fuji", height: 3776, country: "Japan"},
  {name: "Mont Blanc", height: 4808, country: "Italy/France"},
  {name: "Vaalserberg", height: 323, country: "Netherlands"},
  {name: "Denali", height: 6168, country: "United States"},
  {name: "Popocatepetl", height: 5465, country: "Mexico"}
];

console.log(drawTable(dataTable(MOUNTAINS)));