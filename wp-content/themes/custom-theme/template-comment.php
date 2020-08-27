

<?php /* Template Name: Comments */
   get_header(); ?>
<div class="main-container">
   <div class="wrapper narrow-2 margin-topm">
      <form>
         <div id="editor">
            <p>This is the editor content.</p>
         </div>
         <div class="ser-full">
            <div class="ser-full-l">
               <div id="mineiscuz-search-formc">
                  <div class="mineiscuz-search-boxc">        
                     <input type="text" placeholder="Search comments ..." name="search-comment" class="mineiscuz-comm-searchc">
                  </div>
               </div>
            </div>
            <div class="ser-full-r">
               <input id="com-sub" class="wc_comm_submit wpd_not_clicked wpd-prim-button" type="submit" name="submit" value="Post Comment">
            </div>
         </div>
         <div class="comnmine-thread">
            <div id="comnminethread" class="comnminethread">
               <div class="comnminethread-user">
                  <div id="comnmineuser" class="right">
                     <div class="comnmine-header">
                        <div class="comnmine-author">
                           Ben Drohan
                           <div class="comnmine-status"><span class="comnmine-onlinem">Online</span><input type="hidden" class="comnmine-uuid" value="o"></div>
                        </div>
                        <div class="comnmine-date">
                           Jun 26, 7:59 pm
                        </div>
                     </div>
                     <div class="comnmine-text">
                        <p>test comment 12</p>
                     </div>
                     <div class="comnmine-last-edited"><i class="far fa-edit"></i>Last edited 20 hours ago by Ben Drohan</div>
                     <div class="comnmine-footer">
                        <div class="comnmine-vote">
                           <div class="comnmine-vote-up comnmine-not-clicked">
                              <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                 <path fill="none" d="M0 0h24v24H0V0z"></path>
                                 <path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-2z"></path>
                              </svg>
                           </div>
                           <div class="comnmine-vote-result">0</div>
                        </div>
                        <div class="comnmine-reply-button">
                           <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 24 24">
                              <path d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"></path>
                              <path d="M0 0h24v24H0z" fill="none"></path>
                           </svg>
                           <span>Reply</span>
                        </div>
                        <div class="comnmine-tools comnmine-hidden" title="Manage Comment"><i class="fas fa-cog"></i>  </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'editor' );
</script>
<?php get_footer(); ?>

