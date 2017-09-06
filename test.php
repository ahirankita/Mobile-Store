 <script type="text/javascript"	>
	function getData(title)
	 {
      alert(title);
	 }
</script>


<select name="currentList" onChange="getData(this);">
     <option value="hat">Hat</option>
     <option value="shirt">Shirt</option>
     <option value="pants">Pants</option>
</select>