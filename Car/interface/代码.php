$url = 'http://preapi.jslife.net/jsaims/login';
$curl = curl_init();
$post_data = "cid=880002701002185&v=2&usr=880002701002185&psw=880002701002185";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, Array("cid:880002701002185\nv:2\nusr:880002701002185\n:psw:880002701002185"));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
$data = curl_exec($curl);
curl_close($curl);
echo $data;


1231111
