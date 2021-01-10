<form action="#" method="POST" name="register-form" class="form js-form__aut register-form">
		<fieldset> 
              <div class="form__block">
                <div class="form__group form__group_fl form__group_inp">
                  <label for="">Юр. ЛИЦО? <span class="js-info" data-toggle="tooltip" data-placement="left" title="Вы можете заказать товар только в количестве, кратном указанном"></span></label>
                  <div class="switch-wrap form__switch form__switch_mg">
                    <label class="switch">
                      <input type="checkbox" class="">
                      <span class="switch__btn"></span>
                    </label>
                  </div><!-- /switch-wrap -->
                </div>
                <div class="form__group form__group_inp">
                  <label for="nameur">Название Юр. Лица</label>
                  <div class="form__group__field">
                    <input type="text" name="nameur" id="nameur">
                    </div>
                </div>
              </div><!-- /form__block -->
              <div class="form__block">
                <div class="form__group form__group_inp">
                  <label for="last_name">Фамилия</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="last_name" id="lastName" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="first_name">Имя</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="first_name" id="firstName" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
              </div><!-- /form__block -->
              <div class="form__block">
                <div class="form__group form__group_inp">
                  <label for="new_user_name">Username</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="email" name="new_user_name" id="new-username" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                  </div>
                <div class="form__group form__group_inp">
                  <label for="new_user_email">Еmail</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="email" name="new_user_email" id="new-useremail" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="phone">Телефон</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="phone" id="phone" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="adress">Адрес</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="text" name="adress" id="adress" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="ynp">УНП</label>
                  <div class="form__group__field">
                    <input type="text" name="ynp" id="ynp" class="js-validate" placeholder="необязательно">
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="iban">IBAN</label>
                  <div class="form__group__field">
                    <input type="text" name="iban" id="iban" class="js-validate" placeholder="необязательно">
                  </div>
                </div>
              </div><!-- /form__block -->
              <div class="form__block">
                <div class="form__group form__group_inp">
                  <label for="new_user_password">Пароль</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="password" name="new_user_password" id="new-userpassword" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
                </div>
                <div class="form__group form__group_inp">
                  <label for="re-pwd">Повторите пароль</label>
                  <div class="form__group__field js-form__group__field">
                    <input type="password" name="re-pwd" id="re-pwd" class="js-validate">
                    <div><p>Это поле не может быть пустым</p><button class="js-btn__correct">OK</button></div>
                  </div>
				</div>
				<input type="submit" class="button form__btn form__btn_pad js-btn__step_val" id="register-button" value="Зарегистрироваться">
			  </div><!-- /form__block -->
			</fieldset>
        </form>