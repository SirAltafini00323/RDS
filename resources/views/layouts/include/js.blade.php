<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/plugins.min.js')}}"></script>

	<!-- Bootstrap Select Plugin -->
	<script src="{{ asset('js/components/bs-select.js') }}"></script>

	<!-- Bootstrap Switch Plugin -->
	<script src="{{ asset('js/components/bs-switches.js') }}"></script>

	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('js/functions.js')}}"></script>

	<script>

		jQuery(".bt-switch").bootstrapSwitch();
		console.log($)
	</script>

	<script>
		var nbPiece = document.getElementById('nbPiece')
		console.log(nbPiece)
		window.onload = function(){
			var xhr = new XMLHttpRequest()
			xhr.onreadystatechange = function()
            {
                if(this.readyState === 4)
                {
					reponse = JSON.parse(this.response)
					if(reponse.statut == true)
					{
						console.log(reponse)
						nbPiece.innerHTML = reponse.nbPiece
					}
                }
            }
            xhr.open("GET","/paniers/nbPiece",false)
            xhr.send()
		}
	</script>