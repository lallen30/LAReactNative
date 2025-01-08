import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { StorageService } from 'src/app/services/storage.service';
import { ApiService } from 'src/app/services/api.service';
import { NavigationService } from 'src/app/services/navigation.service';


@Component({
  selector: 'app-posts',
  templateUrl: './posts.page.html',
  styleUrls: ['./posts.page.scss'],
})
export class PostsPage implements OnInit {
  public groupedPosts: any[] = [];
  categories: any;

  constructor(public storage: StorageService, private apiService: ApiService, private router: Router, private navService: NavigationService) {
  }

  ngOnInit() { }

  ionViewWillEnter() {
    this.getPostsByCategories();
  }

  singlePost(id) {
    this.router.navigateByUrl(`/tabs/post/${id}`);
  }

  getPostsByCategories() {
    this.storage.get('posts').then((posts) => {
      if (posts != null) {
        this.groupedPosts = posts;
      } else {
        console.log('No posts found in storage.');
      }
    }).catch((error) => {
      console.error('Error getting posts from storage:', error);
    });
  }


  // getPostsByCategories() {
  //   this.apiService.getData('getPostsByCategories').subscribe(
  //     (res: any) => {
  //       if (res.status === "ok") {
  //         this.groupedPosts = res.categories;
  //       } else {
  //         // Handle error here
  //       }
  //     },
  //     (error) => {
  //       console.error(error);
  //     }
  //   );
  // }


}
