// https://codepad.co/snippet/jdLQOUKi
function getSiblings(element, type) {
  var arraySib = [];
  if (type == 'prev') {
    while (element = element.previousElementSibling) {
      arraySib.push(element);
    }
  } else if (type == 'next') {
    while (element = element.nextElementSibling) {
      arraySib.push(element);
    }
  }
  return arraySib;
}

function toggle(a) {
  var b = a.parentElement;
  var prev = getSiblings(b, 'prev');
  var next = getSiblings(b, 'next');
  //<-
  [].forEach.call(prev, function(i) {
    i.classList.add("active");
  });
  //->
  [].forEach.call(next, function(i) {
    i.classList.remove("active");
  });
  b.classList.add("active");
}