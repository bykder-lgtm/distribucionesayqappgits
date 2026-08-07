</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
(function () {
	function matchesSelector(el, sel) {
		if (!el || el.nodeType !== 1) {
			return false;
		}
		var fn = el.matches || el.msMatchesSelector || el.webkitMatchesSelector;
		if (!fn) {
			return false;
		}
		return fn.call(el, sel);
	}

	function findClosestBySelector(startEl, sel) {
		var el = startEl;
		while (el && el !== document) {
			if (matchesSelector(el, sel)) {
				return el;
			}
			el = el.parentNode;
		}
		return null;
	}

	function submitWithButtonData(form, btn) {
		var temps = form.querySelectorAll('input.dayq-confirm-temp');
		for (var i = 0; i < temps.length; i++) {
			temps[i].parentNode.removeChild(temps[i]);
		}
		var name = btn.getAttribute('name');
		var value = btn.getAttribute('value');
		if (name !== null && name !== '' && value !== null && value !== '') {
			var h = document.createElement('input');
			h.type = 'hidden';
			h.name = name;
			h.value = value;
			h.className = 'dayq-confirm-temp';
			form.appendChild(h);
		}
		form.submit();
	}

	function confirmAction(btn, onConfirm) {
		var title = btn.getAttribute('data-dayq-confirm-title') || 'Confirmar acción';
		var message = btn.getAttribute('data-dayq-confirm') || '¿Confirma esta acción?';
		var okLabel = btn.getAttribute('data-dayq-confirm-ok') || 'Confirmar';
		var cancelLabel = btn.getAttribute('data-dayq-confirm-cancel') || 'Cancelar';
		if (window.Swal && typeof window.Swal.fire === 'function') {
			window.Swal.fire({
				title: title,
				text: message,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: okLabel,
				cancelButtonText: cancelLabel,
				reverseButtons: true,
				focusCancel: true,
				confirmButtonColor: '#dc2626',
				cancelButtonColor: '#64748b'
			}).then(function (result) {
				if (result && result.isConfirmed) {
					onConfirm();
				}
			});
			return;
		}
		if (window.confirm(message)) {
			onConfirm();
		}
	}

	document.addEventListener('click', function (e) {
		var btn = findClosestBySelector(e.target, '.dayq-confirm-submit');
		if (!btn) {
			return;
		}
		var form = findClosestBySelector(btn, 'form');
		if (!form) {
			return;
		}
		e.preventDefault();
		confirmAction(btn, function () {
			submitWithButtonData(form, btn);
		});
	});
})();
</script>
</body>
</html>
