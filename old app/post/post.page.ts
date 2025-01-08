import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { NavigationService } from 'src/app/services/navigation.service';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: 'app-post',
  templateUrl: './post.page.html',
  styleUrls: ['./post.page.scss'],
})
export class PostPage implements OnInit {
  public item: any;
  postData: any;
  postsId: any;
  post_title: any = '';
  post_content: any = '';
  featured_image: any = '';
  post_date: any = '';

  constructor(public storage: StorageService, private navService: NavigationService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
  }

  ionViewWillEnter() {
    // Get post id
    const post = this.route.snapshot.paramMap.get('id');
    console.log(`post: ${post}`);
    this.item = post;

    this.storage.get('posts').then((categories) => {
      if (categories != null) {
        for (let category of categories) {
          const foundPost = category.posts.find(post => post.post_id == this.item);
          if (foundPost) {
            this.postData = foundPost;
            console.log('postData:', this.postData);
            console.log('post_title:', this.postData.post_title);

            this.post_title = this.postData.post_title;
            this.post_content = this.postData.post_content;
            this.featured_image = this.postData.featured_image;
            this.post_date = this.postData.post_datetime;
            break;
          }
        }
      }
    });

  }

}
