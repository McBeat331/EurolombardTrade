const validateForm = function(required, formData) {
  let errors = [];
  var parsedobj = JSON.parse(JSON.stringify(formData));

  required.forEach(function(item) {
    for (const key in parsedobj) {
      if (item == key) {
        if(parsedobj[key] <= 0 || parsedobj[key] == null) {
          errors.push(1)
        } 
      }
    }
  });
  return errors.length > 0
}

export {validateForm};