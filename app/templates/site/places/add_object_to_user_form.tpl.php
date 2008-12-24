			<? if (!$this->edit_place) { ?>
				<h2 class="tmarg">Добавление объекта <?=$this->place_name;?> в ваш список</h2><br>
			<? } else { ?>
				<h2 class="tmarg">Редактирование объекта <?=$this->place_name;?></h2><br>				
			<? } ?>
			
			
			<? if (!$this->edit_place) { ?>
				<input type="hidden" name="add_object_to_user" value="1" />
			<? } else { ?>
				<input type="hidden" name="id" value="<?=$this->edit_place->id;?>" />
			<? } ?>
				<table class="taddobj">
					<tr>

						<td class="yright">Годы:</td>
						<td>
							<select name="year_begin" id="yfrom" class="field">
							<?
							$year=date("Y");
							for ($i=$year;$i>$year-80;$i--) {
							?>
								<option value="<?=$i;?>"<?=($this->edit_place?($this->edit_place->date_start==$i?' selected="selected"':''):'');?>><?=$i;?></option>
							<? } ?>
							</select>
							
							&mdash;
							
							<select name="year_end" id="yto" class="field">
							<?
							$year=date("Y");
							for ($i=$year;$i>$year-80;$i--) {
							?>
								<option value="<?=$i;?>"<?=($this->edit_place?($this->edit_place->date_end==$i?' selected="selected"':''):'');?>><?=$i;?></option>
							<? } ?>
							</select>
							
												
						</td>
					</tr>
					<tr>
						<td class="yright">Фамилия на момент окончания:</td>
						<td class="avname"><input type="text" name="surname" id="ysurname" class="field" value="<?=$this->edit_place?$this->edit_place->surname:'';?>" maxlength="50" /></td>
					</tr>
					<tr>
						<td colspan="2">
						<? if (!$this->edit_place) { ?>
							<input type="submit" value="Добавить объект <?=$this->place_name;?> в ваш список" name="create_object_at_user" class="button" style="padding:0px" />
						<? } else { ?>
							<input type="submit" value="Редактировать объект <?=$this->place_name;?>" name="edit_object_at_user" class="button" style="padding:0px" />
						<? } ?>
						</td>

					</tr>
				</table>
