<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml" xmlns:exsl="http://exslt.org/common" extension-element-prefixes="exsl">

<xsl:include href="rewrite.xsl" />
<xsl:include href="replace.xsl" />

<xsl:template match="urls" />
<xsl:template match="forum" />
<xsl:template match="topic" />
<xsl:template match="logininfo" />

<xsl:template match="posts">

    <xsl:call-template name="breadcrumbs">
        <xsl:with-param name="link1">
            <a href="{$rw_cat}{cat/uri}{$rw_cat_ext}" onclick="return f.selectForumIndex('{cat/uri}')"><xsl:value-of select="cat/title" disable-output-escaping="yes" /></a>
        </xsl:with-param>
        <xsl:with-param name="link2">
            <a href="{$rw_forum}{forum/uri}{$rw_forum_page}0{$rw_forum_ext}" onclick="return f.selectForum('{forum/uri}', 0);"><xsl:value-of select="forum/title" disable-output-escaping="yes" /></a>
        </xsl:with-param>        
    </xsl:call-template>

	<div id="reply_container">&#160;</div>

    <xsl:variable name="menu_links">
        <xsl:if test="forum/id != 0 and topic/id != 0">

            <btn href="javascript:void(0);" onclick="return f.newTopic('{forum/uri}')" icon="{/root/urls/img}btn_icon_new_topic.gif">New Topic</btn>

            <xsl:if test="0 = topic/locked">
                <btn href="javascript:void(0);" onclick="return f.postReply('{forum/id}','{topic/id}')" icon="{/root/urls/img}btn_icon_reply.gif">Post Reply</btn>				
            </xsl:if>

            <xsl:if test="0 = topic/flagged">
                <btn href="javascript:void(0);" onclick="return f.flag({topic/id});" icon="{/root/urls/img}btn_icon_flag.gif">Subscribe</btn>
            </xsl:if>
            <xsl:if test="1 = topic/flagged">
                <btn href="javascript:void(0);" onclick="return f.flag({topic/id});" icon="{/root/urls/img}btn_icon_flag.gif">Unsubscribe</btn>
            </xsl:if>

            <xsl:if test="1 = topic/allow_lock_topics">
                <xsl:if test="0 = topic/locked">
                    <btn href="javascript:void(0);" onclick="return f.lock('{topic/id}', '{topic/locked}');" icon="{/root/urls/img}btn_icon_unlocked.gif">Lock</btn>
                </xsl:if>
                <xsl:if test="1 = topic/locked">
                    <btn href="javascript:void(0);" onclick="return f.lock('{topic/id}', '{topic/locked}');" icon="{/root/urls/img}btn_icon_locked.gif">Unlock</btn>
                </xsl:if>
            </xsl:if>

            <xsl:if test="1 = topic/allow_stick_topics">
                <xsl:if test="0 = topic/sticky">
                    <btn href="javascript:void(0);" onclick="return f.stick('{topic/id}');" icon="{/root/urls/img}btn_icon_unsticky.gif">Stick</btn>
                </xsl:if>
                <xsl:if test="1 = topic/sticky">
                    <btn href="javascript:void(0);" onclick="return f.stick('{topic/id}');" icon="{/root/urls/img}btn_icon_sticky.gif">Unstick</btn>
                </xsl:if>
            </xsl:if>

            <xsl:if test="1 = topic/allow_hide_topics and 0 = topic/hidden">
                <btn href="javascript:void(0);" onclick="return f.hideTopic(1, '{topic/id}')" icon="">Hide Topic</btn>				
            </xsl:if>   
            <xsl:if test="1 = topic/allow_unhide_topics and 1 = topic/hidden">
                <btn href="javascript:void(0);" onclick="return f.hideTopic(0, '{topic/id}')" icon="">Unhide Topic</btn>				
            </xsl:if>   

            <xsl:if test="1 = topic/allow_move_topics">
                <btn href="javascript:void(0);" onclick="return f.moveTopicForm('{topic/id}')" icon="">Move Topic</btn>
            </xsl:if>   

            <xsl:if test="1 = topic/allow_del_topics">
                <btn href="javascript:void(0);" onclick="return f.delTopic('{topic/id}', '{forum/uri}', true)" icon="">Delete Topic</btn>
            </xsl:if>   

            <btn href="{$rw_topic}{topic/uri}{$rw_topic_ext}" onclick="" icon="{/root/urls/img}btn_icon_plink.gif">Permalink</btn>

            <btn href="{$rw_rss_topic}{topic/uri}{$rw_rss_topic_ext}" onclick="" icon="{/root/urls/img}btn_icon_rss.gif">RSS Feed</btn>

        </xsl:if>
    </xsl:variable>

    <xsl:call-template name="box">
        <xsl:with-param name="title"><xsl:value-of select="topic/title" disable-output-escaping="yes" /></xsl:with-param>
        <xsl:with-param name="content">
            <xsl:choose>
                <xsl:when test="count(post)">

                    <div class="bx-def-bc-padding">
                        <table class="forum_table_list">
                            <xsl:apply-templates select="post" />
                        </table>
                    </div>

                    <xsl:if test="forum/id != 0 and topic/id != 0 and 0 = topic/locked">
                        <div class="paginate bx-def-padding-left bx-def-padding-right">
                            <div class="view_all">
                                <a href="javascript:void(0);" onclick="return f.postReply('{forum/id}','{topic/id}')" icon="{/root/urls/img}btn_icon_reply.gif">Post Reply</a>
                            </div>
                        </div>
                    </xsl:if>

                </xsl:when>
                <xsl:otherwise>
                    <div class="bx-def-bc-padding">
                        <div class="forum_centered_msg">
                            There are no posts here so far
                        </div>
                    </div>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:with-param>
        <xsl:with-param name="menu" select="exsl:node-set($menu_links)/*" />
    </xsl:call-template>

	<iframe name="post_actions" width="1" height="1" frameborder="1" style="border:none;">&#160;</iframe>

</xsl:template>

<xsl:template match="force_show_post">
	<xsl:call-template name="post_row_box" />
</xsl:template>

<xsl:template match="post">
    <tr>
       <td><div class="bx-def-hr bx-def-margin-sec-top bx-def-margin-sec-bottom"></div></td>
    </tr>
	<tr id="post_row_{@id}">
		<xsl:call-template name="post_row_box" />
	</tr>
</xsl:template>

<xsl:template name="post_row_box">
    <xsl:call-template name="post_row_content" />
</xsl:template>

<xsl:template name="post_row_content">
	<xsl:choose>
        <xsl:when test="((points &lt; min_point) or (vote_user_point = -1) or (1 = hidden)) and (0 = @force_show)">
            <td id="{@id}">			
                <div class="forum_stranger"><i class="sys-icon user"></i><xsl:value-of select="user/title" /></div>
			    <xsl:call-template name="post_row_actions" />
            </td>
		</xsl:when>				
		<xsl:otherwise>
			<td id="{@id}">

                <div class="forum_post_author">

                    <xsl:if test="string-length(user/avatar) &gt; 0">
                        <xsl:call-template name="avatar">
                            <xsl:with-param name="href" select="user/url" />
                            <xsl:with-param name="thumb" select="user/avatar" />
                            <xsl:with-param name="username" select="user/@name" />
                        </xsl:call-template>
                    </xsl:if>

                    <xsl:choose>
                        <xsl:when test="string-length(user/url) &gt; 0">
                            <b class="forum_post_author_title bx-def-font-h2"><a target="_blank" href="{user/url}" onclick="{user/onclick}"><xsl:value-of select="user/title" /></a></b>
                        </xsl:when>
                        <xsl:otherwise>
                            <b class="forum_post_author_title bx-def-font-h2"><xsl:value-of select="user/title" /></b>
                        </xsl:otherwise>
                    </xsl:choose>
                    

                    <span class="forum_stat bx-def-font-grayed">

                        <span class="bullet"> &#183; </span>

                        <xsl:value-of select="user/role" />

                        <span class="bullet"> &#183; </span>

                        <xsl:call-template name="replace_hash">
                            <xsl:with-param name="s" select="string('# posts')"/>
                            <xsl:with-param name="r" select="user/@posts" />
                        </xsl:call-template>

                    </span>

                </div>

                <xsl:call-template name="post_row_actions" />

                <div class="clear_both">&#160;</div>

                <div class="forum_post_text bx-def-font-large bx-def-padding-sec-top">
                    <xsl:choose>
                        <xsl:when test="/root/urls/xsl_mode = 'server'">
                            <xsl:value-of select="text" disable-output-escaping="yes" />
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:choose>
                                <xsl:when test="system-property('xsl:vendor')='Transformiix'">
                                    <div id="{@id}_foo" style="display:none;"><xsl:value-of select="text" /></div>
                                    <script type="text/javascript">
                                        var id = '<xsl:value-of select="@id" />';
                                        <![CDATA[
                                        orca_html_decode (id + '_foo', id);
                                        ]]>
                                    </script>
                                </xsl:when>
                                <xsl:when test="system-property('xsl:vendor')='Microsoft'">
                                    <xsl:value-of select="text" disable-output-escaping="yes" />
                                </xsl:when>
                                <xsl:otherwise>
                                    <xsl:value-of select="text" disable-output-escaping="yes" />
                                </xsl:otherwise>
                            </xsl:choose>
                        </xsl:otherwise>
                    </xsl:choose>

                </div>

                <xsl:if test="attachments/file">
                    <div class="forum_post_attachments bx-def-font-grayed bx-def-padding-sec-top bx-def-margin-sec-top">
                        <xsl:for-each select="attachments/file">
                            <div>
                                <a href="{$base_url}?action=download&amp;hash={@hash}">
                                    <xsl:if test="1 = @image"><xsl:attribute name="target">_blank</xsl:attribute></xsl:if>
                                    <xsl:value-of select="." disable-output-escaping="yes" />
                                </a> 
                                <span class="forum_stat">
                                    <span class="bullet"> &#183; </span>
                                    <xsl:value-of select="@size" disable-output-escaping="yes" /> 
                                    <span class="bullet"> &#183; </span>
                                    <xsl:if test="0 = @image">
                                        <xsl:call-template name="replace_hash">
                                            <xsl:with-param name="s" select="string('# downloads')"/>
                                            <xsl:with-param name="r" select="@downloads" />
                                        </xsl:call-template>
                                    </xsl:if>
                                    <xsl:if test="1 = @image">
                                        <xsl:call-template name="replace_hash">
                                            <xsl:with-param name="s" select="string('# views')"/>
                                            <xsl:with-param name="r" select="@downloads" />
                                        </xsl:call-template>
                                    </xsl:if>
                                </span>
                            </div>
                        </xsl:for-each>
                    </div>
                </xsl:if>

                <xsl:if test="user/signature and '' != user/signature">
                    <div class="forum_post_signature bx-def-font-grayed bx-def-padding-sec-top bx-def-margin-sec-top">
                        <xsl:value-of select="user/signature" />
                    </div>
                </xsl:if>

			</td>

		</xsl:otherwise>
	</xsl:choose>

</xsl:template>

<xsl:template name="post_row_actions">


    <div class="forum_post_actions">        
       
        <span class="forum_stat bx-def-font-grayed">
 
            <xsl:if test="1 = allow_clear_report">
                <a href="javascript:void(0);" onclick="orca_admin.clearReport({@id})">Clear report</a>
                <span class="bullet"> &#183; </span>
            </xsl:if>

            <xsl:if test="1 = allow_hide_posts and 0 = hidden">
                <a href="javascript:void(0);" onclick="f.hidePost(true, {@id}, {../forum/id}, {../topic/id})">Hide</a>
               <span class="bullet"> &#183; </span> 
            </xsl:if>

            <xsl:if test="1 = allow_unhide_posts and 1 = hidden">
                <a href="javascript:void(0);" onclick="f.hidePost(false, {@id}, {../forum/id}, {../topic/id})">Unhide</a>
                <span class="bullet"> &#183; </span>
            </xsl:if>

            <xsl:if test="allow_del = 1">
                <a href="javascript:void(0);" onclick="f.deletePost({@id}, {../forum/id}, {../topic/id}, true)">Delete</a>
                <span class="bullet"> &#183; </span>
            </xsl:if>

            <xsl:if test="allow_edit = 1">
                <a onclick="f.editPost({@id});" href="javascript:void(0);">Edit</a>
                <span class="bullet"> &#183; </span>
            </xsl:if>

            <xsl:if test="(not((points &lt; min_point) or (vote_user_point = -1) or (1 = hidden))) and 0 = ../topic/locked">
                <a href="javascript:void(0);" onclick="return f.postReplyWithQuote({../forum/id}, {../topic/id}, {@id});" onmousedown="f.processSelectedText()">Quote</a>
                <span class="bullet"> &#183; </span>
            </xsl:if>

            <span id="report_{@id}" class="forum_post_actions_report_button">
                <xsl:if test="'' = vote_user_point and user/@name != /root/logininfo/username">
                    <a title="report this post" href="javascript:void(0);" onclick="f.report({@id}); return f.voteBad({@id});">Report</a>
                    <span class="bullet"> &#183; </span>
                </xsl:if>
            </span>

            <xsl:if test="'' = vote_user_point and user/@name != /root/logininfo/username">
                <a href="javascript:void(0);" onclick="return f.voteBad({@id});">Bury</a>
                <span class="bullet"> &#183; </span>
            </xsl:if>

            <span class="forum_post_actions_when">
                <a href="{$rw_topic}{../topic/uri}{$rw_topic_ext}#{@id}"><xsl:value-of select="when" /></a>
            </span>       

            <span class="forum_post_actions_rate" id="rate_{@id}">
                <span class="forum_post_actions_rate_text">

                    <xsl:if test="(points &lt; min_point) or (-1 = vote_user_point) or (1 = hidden)">	
                        <span class="bullet"> &#183; </span>
                        post is hidden (
                            <xsl:choose>
                                <xsl:when test="1 = @force_show">
                                    <a href="javascript:void(0);" onclick="f.hideHiddenPost({@id})">hide post</a>
                                </xsl:when>		
                                <xsl:otherwise>							
                                    <a href="javascript:void(0);" onclick="f.showHiddenPost({@id})">show post</a>
                                </xsl:otherwise>																
                            </xsl:choose>
                            )
                    </xsl:if>

                    <span class="bullet"> &#183; </span>

                    <span id="points_{@id}">
                        <xsl:call-template name="replace_hash">
                            <xsl:with-param name="s" select="string('# people like this')"/>
                            <xsl:with-param name="r" select="points" />
                        </xsl:call-template>
                    </span>

                    <span class="bullet"> &#183; </span>

                </span>

                <span class="forum_post_actions_rate_buttons">
                    <xsl:choose>
                        <xsl:when test="'' = vote_user_point and user/@name != /root/logininfo/username">
                            <a href="javascript:void(0);" onclick="return f.voteGood({@id});" style="margin-right:3px;" title="Like"><i title="Like" class="vote_good sys-icon thumbs-up"></i></a>
                        </xsl:when>
                        <xsl:otherwise>					
                            <a href="javascript:void(0);" style="margin-right:3px;" title="Like"><i title="Like" class="vote_good sys-icon thumbs-up bx-def-font-grayed"></i></a>
                        </xsl:otherwise>
                    </xsl:choose>
                </span>
            </span>	

        </span>

    </div>

</xsl:template>

</xsl:stylesheet>


