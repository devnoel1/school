<form method="post" action="process.php?sectn=<?=$sec?>&apv_fee&user=<?=$user;?>">
                  <div class="form-group">
                      <label>Registration Number</label>
                      <input type="text" name="std_reg" class="form-control" required="" placeholder="enter student registration number...">
                  </div>
                  <div class="form-group">
                              <label>Class</label>
                              <select name="cls" class="form-control">
                                  <option value="">select Class</option>
                                  <?php
                                    $result = $handle->fetchQuery("select * from class where section = '$sec' ");
                                    foreach($result as $v):
                                  ?>
                                  <option value="<?=$v['cls_id'];?>"><?=$v['cls_name'];?></option>
                                  <?php
                                    endforeach;
                                  ?>
                              </select>
                          </div>
                  <div class="form-group">
                              <label>Session</label>
                              <select name="ses" class="form-control">
                                  <option value="">select session</option>
                                  <?php
                                    $result = $handle->fetchQuery("select * from acc_session ");
                                    foreach($result as $v):
                                  ?>
                                  <option value="<?=$v['ses_id'];?>"><?=$v['ses_name'];?></option>
                                  <?php
                                    endforeach;
                                  ?>
                              </select>
                          </div>
                              <div class="form-group">
                              <label>Term</label>
                              <select name="term" class="form-control">
                                  <option value="">select term</option>
                                  <?php
                                    $result = $handle->fetchQuery("select * from term ");
                                    foreach($result as $v):
                                  ?>
                                  <option value="<?=$v['term_id'];?>"><?=$v['term_name'];?></option>
                                  <?php
                                    endforeach;
                                  ?>
                              </select>
                          </div>
                          <div class="form-group">
                      <label>Amount</label>
                      <input type="number" name="amount" class="form-control" required="" placeholder="enter Amount...">
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-info btn-block">Submit</button> 
                  </div>
              </form>