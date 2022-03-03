<table border="1" width="100%">
	<tr>
		<th><?php $this->getHeader()->toHtml(); ?></th>
	</tr>

	<tr>
		<td><?php $this->getContent()->toHtml(); ?></td>
	</tr>

	<tr>
		<td><?php $this->getFooter()->toHtml(); ?></td>
	</tr>
</table>
