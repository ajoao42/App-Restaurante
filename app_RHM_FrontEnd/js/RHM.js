function removerUsuario(iduser)
{
	location.href = 'usuario.php?accao=deleteUser&id='+iduser
}

function removerCliente(idcliente)
{
	location.href = 'cliente.php?accao=deleteCliente&id='+idcliente
}

function removerMesa(idmesa)
{
	location.href = 'mesa.php?accao=deleteMesa&id='+idmesa
}

function removerReserva(idreserva)
{
	location.href = 'reserva.php?accao=deleteReserva&id='+idreserva
}

