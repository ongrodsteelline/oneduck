<?php
function show_profile_fields( $user ) { ?> 
 	<h3>Дополнительная информация</h3>
 	<!-- добавляется ещё один блок в профиле, в примере он будет называться "Дополнительная информация" -->
 	<table class="form-table">
 	<!-- для того чтобы ваши поля выглядели так же, как и стандартные в WordPress, прописывайте такие же классы как и тут -->
 	<tr><th><label for="nameur">НАЗВАНИЕ ЮР. ЛИЦА</label></th>
 	<td><input type="text" name="nameur" id="nameUr" value="<?php echo esc_attr(get_the_author_meta('nameur',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	<tr><th><label for="phone">Телефон</label></th>
 	<td><input type="text" name="phone" id="phone" value="<?php echo esc_attr(get_the_author_meta('phone',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	<tr><th><label for="adress">Адрес</label></th>
 	<td><input type="text" name="adress" id="adress" value="<?php echo esc_attr(get_the_author_meta('adress',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	<tr><th><label for="ynp">УНП</label></th>
 	<td><input type="text" name="ynp" id="ynp" value="<?php echo esc_attr(get_the_author_meta('ynp',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	<tr><th><label for="iban">IBAN</label></th>
 	<td><input type="text" name="iban" id="iban" value="<?php echo esc_attr(get_the_author_meta('iban',$user->ID));?>" class="regular-text" /><br /></td></tr>
 	<!-- закрываем теги и применяем функцию -->
 	</table>
 <?php }
add_action( 'show_user_profile', 'show_profile_fields' );
add_action( 'edit_user_profile', 'show_profile_fields' );

function save_profile_fields( $user_id ) {
	update_usermeta( $user_id, 'nameur', $_POST['nameur'] );
	update_usermeta( $user_id, 'phone', $_POST['phone'] );
	update_usermeta( $user_id, 'adress', $_POST['adress'] );
	update_usermeta( $user_id, 'ynp', $_POST['ynp'] );
	update_usermeta( $user_id, 'iban', $_POST['iban'] );
}
 
add_action( 'personal_options_update', 'save_profile_fields' );
add_action( 'edit_user_profile_update', 'save_profile_fields' );