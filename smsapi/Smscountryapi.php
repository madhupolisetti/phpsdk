<?php
class Smscountryapi
{
    protected $authKey="";
    protected $authToken="";
	protected $url="https://restapi.smscountry.com/v0.1/Accounts";
	//protected $headers=array('Content-Type: application/json');
	protected $headers=array();
	
	public function __construct ( $authKey, $authToken ) {
    $this->authKey = $authKey;
    $this->authToken = $authToken;
	$this->headers = array(  
		"Content-Type: application/json",
		"Authorization: Basic ". base64_encode($this->authKey . ":" . $this->authToken)
		);
	}
    public function getSmsDetails($messageUUID="d8f39d9a-8a36-4974-8b92-7ae0b83a1aa2")
    {
		
		$rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/SMSes/".$messageUUID."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);  
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;  

    }
	 public function getSmsCollection($FromDate="00:0",$ToDate="23:59:59",$SenderId="",$offset="",$limit=10,$tool="All")
    {
		
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/SMSes/?FromDate=".urlencode($FromDate)."&ToDate=".urlencode($ToDate)."&SenderId=".urlencode($SenderId)."&Offset=".urlencode($offset)."&Limit=".urlencode($limit)."&Tool=".urlencode($tool));
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);  
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
	public function sendSms($Text="hello",$Number="7206644479",$SenderId="",$DRNotifyUrl="",$RNotifyHttpMethod="POST",$tool="All")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/SMSes/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers); 
		curl_setopt($rest, CURLOPT_POST, TRUE);
		curl_setopt($rest, CURLOPT_POSTFIELDS, "{
				\"Text\": \"$Text\",
				\"Number\": \"$Number\",
				\"SenderId\": \"$SenderId\",
				\"DRNotifyUrl\": \"$DRNotifyUrl\",
				\"DRNotifyHttpMethod\": \"$RNotifyHttpMethod\",
				\"Tool\": \"$tool\"
			}");
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
	public function sendBulkSms($Text="123456789",$Numbers=array(),$SenderId="",$DRNotifyUrl="",$DRNotifyHttpMethod="POST")
    {
			print_r($this->numberArraycon($Numbers));
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/BulkSMSes/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers); 
		curl_setopt($rest, CURLOPT_POST, TRUE);
		curl_setopt($rest, CURLOPT_POSTFIELDS, "{
				\"Text\": \"$Text\",
				\"Numbers\": [$this->numberArraycon($Numbers)],
				\"SenderId\": \"$SenderId\",
				\"DRNotifyUrl\": \"$DRNotifyUrl\",
				\"DRNotifyHttpMethod\": \"$DRNotifyHttpMethod\"
			}");
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
	public function numberArraycon($Numbers=array())
	{
		$num='';
		for($i=0;$i<count($Numbers);$i++)
		{
			$num.="\"$Numbers[$i]\",";
		}
		return rtrim($num,',');
	}
	
	/** Calls ***/
	public function getCallDetails($callUUID)
    {
		
		$rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Calls/".$callUUID."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);  
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;  

    }
	 public function getCallsList($FromDate="00:0",$ToDate="23:59:59",$CallerId="",$offset="",$limit=10)
    {
		
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Calls/?FromDate=".urlencode($FromDate)."&ToDate=".urlencode($ToDate)."&CallerId=".urlencode($CallerId)."&Offset=".urlencode($offset)."&Limit=".urlencode($limit));
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);  
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
	public function createNewCall($Number="",$CallerId="",$RingUrl="",$AnswerUrl="",$HangupUrl="",$HttpMethod="POST",$Xml="xxx")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Calls/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers); 
		curl_setopt($rest, CURLOPT_POST, TRUE);
		curl_setopt($rest, CURLOPT_POSTFIELDS, "{
					\"Number\": \"$Number\",
					\"CallerId\": \"$CallerId\",
					\"RingUrl\": \"$RingUrl\",
					\"AnswerUrl\": \"$AnswerUrl\",
					\"HangupUrl\": \"$HangupUrl\",
					\"HttpMethod\": \"$HttpMethod\",
					\"Xml\": \"<Request><play>$Xml</play></Request>\"
					}");
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function createbulkcall($Number="7206659903",$CallerId="",$RingUrl="",$AnswerUrl="http://hourlylancer.com/answerurl",$HangupUrl="",$HttpMethod="POST",$Xml="xxx")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/BulkCalls/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers); 
		curl_setopt($rest, CURLOPT_POST, TRUE);
		curl_setopt($rest, CURLOPT_POSTFIELDS, "{
					\"Number\": \"$Number\",
					\"CallerId\": \"$CallerId\",
					\"RingUrl\": \"$RingUrl\",
					\"AnswerUrl\": \"$AnswerUrl\",
					\"HangupUrl\": \"$HangupUrl\",
					\"HttpMethod\": \"$HttpMethod\",
					\"Xml\": \"<Request><play>$Xml</play></Request>\"
					}");
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function disconnectCall($apiId="8c6ce9fb-9cdd-4fbb-be90-c41962302a71")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Calls/".$callUUID."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    /*** Groups ***/
    
    public function createNewGroup($Name="123456789",$TinyName="",$StartGroupCallOnEnter="",$EndGroupCallOnExit="",$Members="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers); 
		curl_setopt($rest, CURLOPT_POST, TRUE);
		curl_setopt($rest, CURLOPT_POSTFIELDS, "{
					\"Name\": \"$Name\",
					\"TinyName\": \"$TinyName\",
					\"StartGroupCallOnEnter\": \"$StartGroupCallOnEnter\",
					\"EndGroupCallOnExit\": \"$EndGroupCallOnExit\",
					\"Members\": \"$Members\",
					}");
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function GroupDetails($groupid="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }

   public function GetGroupsCollection($nameLike="",$StartGroupCallOnEnter="",$EndGroupCallOnExit="",$TinyName="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/?".$nameLike,	$StartGroupCallOnEnter,$EndGroupCallOnExit,$TinyName);
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers); 
		curl_setopt($rest, CURLOPT_POST, TRUE);
		curl_setopt($rest, CURLOPT_POSTFIELDS, "{
					\"nameLike\": \"$nameLike\",
					\"StartGroupCallOnEnter\": \"$StartGroupCallOnEnter\",
					\"EndGroupCallOnExit\": \"$EndGroupCallOnExit\",
					\"TinyName\": \"$TinyName\",
					}");
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function UpdateGroup($groupid="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function DeleteGroup($groupid="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function MemberDetails($groupid="", $MemberId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/Member".$MemberId."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function GetAllMembers($groupid="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/Member/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function UpdateMemberDetail($groupid="", $MemberId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/Member".$MemberId."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function DeleteMemberInGroup($groupid="", $MemberId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/Member".$MemberId."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function AddMemberExistingGroup($groupid="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/".$groupid."/Members/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    /*** Group Calls ***/
    
    public function CreateGroupCall() {
    $name="SampleGrpCall20";
    $WelcomeSound="";
    $WaitSound="";
    $StartGropCallOnEnter="";
    $EndGroupCallOnExit="";
    $AnswerUrl="http://hourlylancer.com/smsapi/";
    $Participants = array(
		   array(
			   "Name"=> "test",
			   "Number"=> "123456"
		   ),
		   array(
			   "Name"=> "test1",
			   "Number"=> "987456"
		   ),
			array(
			   "Name"=> "test2",
			   "Number"=> "456321"
		   )
       );
		$d = array(
		"Name"=> $name,
		"WelcomeSound"=> $WelcomeSound,
		"WaitSound"=> $WaitSound,
		"StartGropCallOnEnter"=> $StartGropCallOnEnter,
		"EndGroupCallOnExit"=> $EndGroupCallOnExit,
		"AnswerUrl"=> $AnswerUrl,
        "Participants" => $Participants
   );
   $abc = json_encode($d);
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/");
		curl_setopt($rest,CURLOPT_HTTPHEADER, $this->headers); 
		curl_setopt($rest, CURLOPT_POST, TRUE);
		curl_setopt($rest, CURLOPT_POSTFIELDS, $abc);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true); 
		//~ echo '<pre>';
		//~ print_r($rest);
		 
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function GetGroupCallList($FromDate="",$ToDate="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/Groups/?".$FromDate,$ToDate);
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function GroupCallDetails($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function ParticipantDetails($GroupCallUUID ="",$ParticipantId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Participants".$ParticipantId."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function ParticipantsDetails($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Participants/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function GroupCallPlaySound($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Play/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function PlaySoundParticipantCall($GroupCallUUID ="", $ParticipantId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Participants".$ParticipantId."/Play/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function MuteAllParticipant($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Mute/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function MuteParticipant($GroupCallUUID ="", $ParticipantId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Participants".$ParticipantId."/Mute/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function UnMuteAllParticipants($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/UnMute/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function UnMuteParticipants($GroupCallUUID ="", $ParticipantId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Participants".$ParticipantId."/UnMute/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function StartRecordingGroupCall($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Recordings/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function StopRecordingGroupCall($GroupCallUUID ="", $RecordingUUID="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Recordings".$RecordingUUID."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function StopAllRecordingsGroupCall($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Recordings/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function GetRecordingGroupCall($GroupCallUUID ="", $RecordingUUID="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Recordings".$RecordingUUID."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function GetAllRecordingsDetails($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Recordings/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function DeleteRecordingGroupCall($GroupCallUUID ="", $RecordingUUID="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Recordings".$RecordingUUID."/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function DeleteAllRecordingsGroupCall($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Recordings/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function DisconnectAllParticipants($GroupCallUUID ="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Hangup/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }
    
    public function DisconnectParticipant($GroupCallUUID ="", $ParticipantId="")
    {
       $rest = curl_init();  
		curl_setopt($rest,CURLOPT_URL,$this->url."/".$this->authKey."/GroupCalls/".$GroupCallUUID."/Participants".$ParticipantId."/Hangup/");
		curl_setopt($rest,CURLOPT_HTTPHEADER,$this->headers);
		curl_setopt($rest,CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
		$response = curl_exec($rest);  
		return $response;

    }

}

?>
