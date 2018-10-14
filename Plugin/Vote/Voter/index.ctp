<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row">

        <h2 style="font-size:45px;margin-top:40px;margin-bottom: 60px;text-transform: uppercase;" class="section-title text-center wow fadeInDown">☰=- <?= $Lang->get('VOTE__TITLE') ?> -=☰</h2>

    </div>
  </div>
</div>
<div id="content">
  <section class="bar background-white">
    <div class="container vote">
  	  <div class="row">
  		  <div class="col-md-12">

  			  <div id="website_infos"></div>

    			<!-- Choose website -->
    				<div style="border:none;text-align: center;" class="panel panel-default panel-step step0">
    				  <div class="panel-heading">
    				    <h3 style="font-family: 'Montserrat Subrayada', sans-serif;" class="panel-title"><?= $Lang->get('VOTE__STEP_TITLE') ?> 0 : <?= $Lang->get('VOTE__STEP_0_TITLE') ?> <i style="display:none" class="glyphicon glyphicon-ok"></i></h3>
    				  </div>
    				  <div class="panel-body">
    				  	<?php foreach ($websites as $key => $value) { ?>
    				  		<div class="col-md-4">
    							<button style="margin-bottom:5px;" class="btn-vote btn btn-primary choose_website btn-block" id="<?= $key ?>"><?= $value['website_name'] ?></button>
    						</div>
    					<?php } ?>
    				  </div>
    				</div>
    				<script step-id="0">
    					$('.choose_website').click(function(e) {
    						$('.step0').css('opacity', '0.7');
    						$('.step0').find('i').css('display', 'inline-block');
    						$('.step0 button').each(function(e) {
    							$(this).attr('disabled');
    							$(this).addClass('disabled');
    						});
    						$('.step1').css('opacity', '');
    						inputs = {};
    						inputs['website'] = $(this).attr('id');
    						inputs["data[_Token][key]"] = '<?= $csrfToken ?>'
    						$.post("<?= $this->Html->url(array('plugin' => 'vote', 'controller' => 'voter', 'action' => 'setWebsite')) ?>", inputs, function(data) {
    							data = JSON.parse(data);
    							$('.btn-step2').attr('href', data.page);
    							var website_type = data['website_type'];
    							if(website_type == 'rpg') { // si rpg
    								$('#step4_title').html('4');
    								$('.step3').show();
    								$('.sec')[1].remove();
    							}
    							$('#website_infos').attr('data-type', website_type);

    							$('.input-step1').attr('disabled', false);
    							$('.input-step1').removeClass('disabled');

    							$('.btn-step1').attr('disabled', false);
    							$('.btn-step1').removeClass('disabled');

    						});
    					});
    				</script>
    			<!-- _____________ -->

    			<!-- Choose username -->
    				<div style="border:none;text-align: center;" class="panel panel-default panel-step step1" style="opacity : 0.5;">
    				  <div class="panel-heading">
    				    <h3 style="font-family: 'Montserrat Subrayada', sans-serif;" class="panel-title"><?= $Lang->get('VOTE__STEP_TITLE') ?> 1 : <?= $Lang->get('USER__LOGIN') ?> <i style="display:none" id="icon_step1" class="glyphicon glyphicon-ok"></i></h3>
    				  </div>
    				  <div class="panel-body">
    				    <form class="form-inline" data-ajax="true" action="<?= $this->Html->url(array('action' => 'setPseudo')) ?>" data-callback-function="step1">
    					  	<div class="form-group">
    					    	<label class="sr-only">Pseudo</label>
    					    	<input type="text" class="form-control input-lg input-step1 disabled" name="pseudo" placeholder="<?= $Lang->get('VOTE__MC_USERNAME') ?>" disabled>
    					  	</div>
    					  	<button type="submit" class="btn-vote btn btn-primary btn-lg btn-step1 disabled" disabled><?= $Lang->get('USER__LOGIN') ?></button>
    						</form>
    				  </div>
    				</div>
    				<script type="text/javascript" step-id="1">
    					function step1(inputs, data) {
    						$('#icon_step1').css("display", "");
    						$('.step1').css("opacity", "0.7");
    						$('.step2').css("opacity", "");
    						$('.btn-step2').removeClass('disabled');
    						$('.input-step1').prop('disabled', true);
    						$('#script_step1').remove();

    						$('.input-step1').attr('disabled', 'disabled');
    						$('.input-step1').addClass('disabled');

    						$('.btn-step1').attr('disabled', 'disabled');
    						$('.btn-step1').addClass('disabled');
    					}
    				</script>
    			<!-- _______________ -->

    			<!-- Vote -->
    				<div style="border:none;text-align: center;" class="panel panel-default panel-step step2" style="opacity : 0.5;">
    				  <div class="panel-heading">
    				    <h3 style="font-family: 'Montserrat Subrayada', sans-serif;" class="panel-title"><?= $Lang->get('VOTE__STEP_TITLE') ?> 2 : <?= $Lang->get('VOTE__VOTE_ACTION') ?> <i style="display:none" id="icon_step2" class="glyphicon glyphicon-ok"></i></h3>
    				  </div>
    				  <div class="panel-body">
    				  	<p><?= $Lang->get('VOTE__STEP_2_DESC') ?></p>
    				  	<a class="btn-vote btn btn-primary btn-block btn-step2 disabled" href="#" target="_blank">Voter</a>
    				  </div>
    				</div>
    				<script type="text/javascript" step-id="2">
    					$(".btn-step2").click( function() {
    				      	var i = 15;
    				      	function compteur() {
    				        	$(".sec").html(" : "+i);
    				        	i = i - 1;
    				        	if(i>-1) {
    				          		timer = setTimeout(function() {
    				            		compteur();
    				          		}, 1000);
    				        	} else {
    				          		$(".sec").css("display", "none");
    				          		$(".step2").css("opacity", "0.7");
    				          		$(".step3").css("opacity", "");
    				          		$('.btn-step2').addClass('disabled');
    				          		$('#icon_step2').css("display", "");
    				          		$('#script_step2').remove();

    				          		if($('#website_infos').attr('data-type') == "rpg") {
    						    		$('.btn-step3').removeClass('disabled');
    						    		$('.input-step3').prop('disabled', false);
    						    	} else {
    						    		$('.step4').css("opacity", "");
    						    		$('#step4').removeClass('disabled');
    						    		$('.btn-step4').removeClass('disabled');
    						    	}
    				        	}
    				      	}
    				        compteur();
    				    });
    				</script>
    			<!-- _____ -->

    			<!-- Verification of OUT -->
    				<div class="panel panel-default panel-step step3" style="display:none;opacity : 0.5;">
    				  <div class="panel-heading">
    				    <h3 class="panel-title"><?= $Lang->get('VOTE__STEP_TITLE') ?> 3 : <?= $Lang->get('VOTE__STEP_3_TITLE') ?> <span class="sec"></span><i style="display:none" id="icon_step3" class="glyphicon glyphicon-ok"></i></h3>
    				  </div>
    				  <div class="panel-body">
    				  	<p><?= $Lang->get('VOTE__STEP_3_DESC') ?></p>
    						<form class="form-inline" data-ajax="true" action="<?= $this->Html->url(array('action' => 'checkOut')) ?>" data-callback-function="step3">
    					  <div class="form-group">
    					    <label class="sr-only">OUT</label>
    					    <input type="text" class="form-control input-step3" name="out" placeholder="<?= $Lang->get('VOTE__STEP_3_INPUT_PLACEHOLDER') ?>" disabled="">
    					  </div>
    					  <button type="submit" class="btn btn-primary btn-step3 disabled"><?= $Lang->get('GLOBAL__SUBMIT') ?></button>
    					</form>
    				  </div>
    				</div>
    				<script type="text/javascript" step-id="3">
    					function step3(inputs, data) {
    			    	$('#icon_step3').css("display", "");
    			    	$('.step3').css("opacity", "0.7");
    			    	$('.step4').css("opacity", "");
    			    	$('.btn-step3').addClass('disabled');
    			    	$('#step4').removeClass('disabled');
    			    	$('.btn-step4').removeClass('disabled');
    			    	$('.input-step3').prop('disabled', true);
    			      $('#script_step3').remove();
    					}
    				</script>
    			<!-- ________________ -->

    			<div style="border:none;text-align: center;" class="panel panel-default panel-step step4" style="opacity : 0.5;">
    			  <div class="panel-heading">
    			    <h3 style="font-family: 'Montserrat Subrayada', sans-serif;" class="panel-title"><?= $Lang->get('VOTE__STEP_TITLE') ?> <span id="step4_title">3</span> : <?= $Lang->get('VOTE__REWARDS_TITLE') ?> <span class="sec"></span><i style="display:none" id="icon_step4" class="glyphicon glyphicon-ok"></i></h3>
    			  </div>
    			  <div class="panel-body">
    			  	<p><?= $Lang->get('VOTE__STEP_4_DESC') ?></p>
    			  	<button class="btn-vote btn btn-primary btn-block btn-step4 disabled" id="now"><?= $Lang->get('VOTE__STEP_4_REWARD_NOW') ?></button>
    			  	<button class="btn-vote btn btn-primary btn-block btn-step4 disabled" id="later"><?= $Lang->get('VOTE__STEP_4_REWARD_LATER') ?></button>
    			  </div>
    			  	<div class="response_step4"></div>
    			</div>
          <script type="text/javascript">

            $(".btn-step4").click( function(e) {
              e.preventDefault();
              $('.response_step4').html('<div class="panel-footer"><div class="alert alert-info" style="margin-bottom:0px;"><?= $this->Html->image('ajax-loader.gif') ?> <?= $Lang->get('GLOBAL__LOADING') ?> ...</div></div>');
              inputs = {};
              inputs['when'] = $(this).attr('id');
              inputs["data[_Token][key]"] = '<?= $csrfToken ?>'
              $.post("<?= $this->Html->url(array('plugin' => 'vote', 'controller' => 'voter', 'action' => 'getRewards')) ?>", inputs, function(data) {
                data = JSON.parse(data);
                if(data.statut) {
                  $('#icon_step4').css("display", "");
                  $('.step4').css("opacity", "0.7");
                  $('.step4 .response_step4').css("opacity", "");
                  $('.btn-step4').addClass('disabled');
                  $('.response_step4').html('<div class="panel-footer"><div class="alert alert-success" style="margin-bottom:0px;"><b><?= $Lang->get('GLOBAL__SUCCESS') ?> : </b>'+data.msg+'</div></div>');
                  $('#script_step4').remove();
                } else {
                  $('.response_step4').html('<div class="panel-footer"><div class="alert alert-danger" style="margin-bottom:0px;"><b><?= $Lang->get('GLOBAL__ERROR') ?> : </b>'+data.msg+'</div></div>');
                }
              });
            });
          </script>
        </div>
  	  </div>
    </div>
  </section>
</div>

<section id="cta">
			<div class="container">
					<div class="reward-header">
						<h4 style="color:white;text-align: center;text-transform: uppercase;font-size:32px;" class="modal-title" id="myModalLabel">☰═ <?= $Lang->get('VOTE__REWARDS_TITLE') ?> ═☰</h4>
					</div>
					<div class="modal-body">
						<table class="table table-striped">
								<thead>
									<tr>
											<th style="color:white;">Nom</th>
											<th style="color:white;"><?= $Lang->get('VOTE__CONFIG_REWARD_PROBABILITY') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($rewards as $key => $value) {
											echo '<tr>';
												echo '<td>';
													echo ($value['type'] == "money") ? $value['how'].' '.$Configuration->getMoneyName() : $value['name'];
												echo '</td>';
												echo '<td>'.$value['proba'].'%</td>';
											echo '</tr>';
										}
									?>
							</tbody>
						</table>
					</div>				
			</div>
</section>




			<div style="margin-top:3%;" class="container">
					<div class="classement-header">
						<h4 class="modal-title" id="myModalLabel"><?= $Lang->get('VOTE__RANKING_TITLE') ?></h4>
					</div>
					<div class="modal-body">
						<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
											<th>Nom</th>
											<th>Nbr. vote</th>
									</tr>
								</thead>
								<tbody>
										<?php
										$i = 0;
										foreach ($ranking as $key => $value) {
										$i++;
										?>
											<tr>
												<td><?= $i ?></td>
												<td><?= $value['User']['pseudo'] ?></td>
												<td><?= $value['User']['vote'] ?></td>
											</tr>
						<?php } ?>
					</tbody>
						</table>
						</div>	
                      <div class="modal-footer">
                    
                </div>  			
			</div>


