import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ApiService } from 'src/app/services/api.service';
import { CommonService } from 'src/app/services/common.service';

@Component({
  selector: 'app-bluestone-ai',
  templateUrl: './bluestone-ai.page.html',
  styleUrls: ['./bluestone-ai.page.scss'],
})
export class BluestoneAiPage implements OnInit {
  showWelcomeMessage: boolean = true;
  aiForm: FormGroup;
  reply_content: any;
  aiWelcomeMessage: any;
  aiApiUrl: any;


  constructor(private formBuilder: FormBuilder, private commonService: CommonService, private apiService: ApiService) {
    this.aiForm = this.formBuilder.group({
      question: ['', Validators.required],
    });
  }

  ngOnInit() {
    this.getAIApiUrl();
    this.getAIWelcome();
  }

  getAIApiUrl() {
    this.apiService.getData("get_ai_api_url").subscribe(
      (res: ApiResponse) => {
        console.log("res: ", res);
        if (res.status === "success") {
          this.aiApiUrl = res.message;
          console.log("aiApiUrl: ", this.aiApiUrl);
          this.apiService.setAiApiUrl(this.aiApiUrl);
        } else {
          this.commonService.presentToast(res.status);
        }
        this.apiService.dismissLoading();
      },
      (error) => {
        this.apiService.dismissLoading();
        this.commonService.presentToast("Something went wrong!");
      }
    );
  }

  getAIWelcome() {
    this.apiService.getData("get_ai_welcome").subscribe(
      (res: ApiResponse) => {
        console.log("res: ", res);
        if (res.status === "success") {
          this.aiWelcomeMessage = res.message;
        } else {
          this.commonService.presentToast(res.status);
        }
        this.apiService.dismissLoading();
      },
      (error) => {
        this.apiService.dismissLoading();
        this.commonService.presentToast("Something went wrong!");
      }
    );
  }


  submitQuestion() {
    if (this.aiForm.valid) {
      this.apiService.showLoader();
      this.apiService.postQuestionToQnA(this.aiForm.value).subscribe(
        response => {
          console.log('Response:', response);
          this.reply_content = response.answer;
          this.showWelcomeMessage = false;
          this.aiForm.reset();
          this.saveQuestionAnswer(response);
          this.apiService.dismissLoading();
        },
        error => {
          this.apiService.dismissLoading();
          console.error('Error:', error);
          this.apiService.errorToast('An error occurred while submitting the question.');
        }
      );
    } else {
      this.apiService.errorToast('Please enter a valid question.');
    }
  }


  saveQuestionAnswer(questionAnswer: string) {
    this.apiService.sendData('save_ai_qna', questionAnswer).subscribe(
      (response: any) => {
        if (response) {
          console.log('response: ', response);
        } else {
          console.error('Reply not found in the response');
        }
      },
      (err) => {
        console.error(err);
      }
    );
  }


}

interface ApiResponse {
  message: string;
  error: string;
  status: string;
  term_page: {
    post_title: string;
    post_content: string;
  };
}
