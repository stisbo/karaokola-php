(async () => {
  var { u_w_s, u_base } =  await variables();
  console.log(u_w_s, u_base)
})();


async function variables (){
  try {
    const res = await $.ajax({
      type:"GET",
      url: '../js/config.xml',
      dataType: 'xml',
    });
    console.log(res)
    const xml = $(res);
    const url = xml.find('socket').text();
    const base = xml.find('ruta-base').text();
    return { u_w_s: url, u_base: base }
  } catch (error) {
    console.log(error)
    return { u_w_s: '', u_base: '' }
  }
};
